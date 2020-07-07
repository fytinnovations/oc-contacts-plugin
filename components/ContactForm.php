<?php

namespace Fytinnovations\Contacts\Components;

use Cms\Classes\ComponentBase;
use Cms\Classes\Page;
use Flash;
use Fytinnovations\Contacts\Models\Contact;
use Fytinnovations\Contacts\Models\Message;
use Lang;
use Mail;
use Redirect;
use Backend\Models\User as BackendUser;

class ContactForm extends ComponentBase
{

    public function componentDetails()
    {
        return [
            'name'        => 'fytinnovations.contacts::lang.components.contactform.name',
            'description' => 'fytinnovations.contacts::lang.components.contactform.description'
        ];
    }

    public function defineProperties()
    {
        return [
            'redirectPage' => [
                'title'       => 'fytinnovations.contacts::lang.components.contactform.redirect_page',
                'description' => 'fytinnovations.contacts::lang.components.contactform.redirect_page_desc',
                'type'        => 'dropdown',
                'default'     => ''
            ],
            'successMessage'  => [
                'title'       => 'fytinnovations.contacts::lang.components.contactform.success_message',
                'description' => 'fytinnovations.contacts::lang.components.contactform.success_message_desc',
                'type'        => 'text',
                'default'     => Lang::get('fytinnovations.contacts::lang.components.contactform.success_message_default')
            ],
            'enableEmailNotification' => [
                'title'       => 'fytinnovations.contacts::lang.components.contactform.enable_email_notification',
                'description' => 'fytinnovations.contacts::lang.components.contactform.enable_email_notification_desc',
                'type'        => 'checkbox',
                'default'     => false
            ]
        ];
    }

    public function getRedirectPageOptions()
    {
        return ['' => '- refresh page -'] + Page::sortBy('baseFileName')->lists('baseFileName', 'baseFileName');
    }

    public function onSave()
    {
        /** Create and save a new contact if it does not exist or else use the existing contact */
        $data = post();
        $contact = Contact::firstOrNew(['email' => $data['email']]);
        $contact->fill($data);
        $contact->save();

        $message = new Message;
        $message->fill($data);
        $message->contact = $contact;
        $message->save();

        if ($this->property('enableEmailNotification')) {
            Mail::send('fytinnovations.contacts::mail.contact_form_submitted', $data, function ($message) use ($data) {

                $emailRecipients = $this->getAdministratorEmails();

                $message->to($emailRecipients);
            });
        }
        
        Flash::success($this->property('successMessage'));

        if (!$this->property('redirectPage')) {
            return Redirect::refresh();
        }

        return Redirect::to($this->redirectPage);
    }

    protected function getAdministratorEmails()
    {
        $emails = BackendUser::where('is_superuser', true)->get()->pluck('email');

        return $emails->toArray();
    }
}

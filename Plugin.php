<?php

namespace Fytinnovations\Contacts;

use Backend;
use BackendAuth;
use Fytinnovations\Contacts\Components\ContactForm;
use Fytinnovations\Contacts\Models\Message;
use System\Classes\PluginBase;

/**
 * Contacts Plugin Information File
 */
class Plugin extends PluginBase
{

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'fytinnovations.contacts::lang.plugin.name',
            'description' => 'fytinnovations.contacts::lang.plugin.description',
            'author'      => 'Fytinnovations',
            'icon'        => 'icon-leaf'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {
    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return [
            ContactForm::class => 'contactForm'
        ]; // Remove this line to activate
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return []; // Remove this line to activate

        return [
            'fytinnovations.contacts.some_permission' => [
                'tab' => 'fytinnovations.contacts::lang.plugin.name',
                'label' => 'fytinnovations.contacts::lang.permissions.some_permission'
            ],
        ];
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
        $unReadMessageCount = Message::unread(BackendAuth::getUser())->get()->count();

        return [
            'contacts' => [
                'label'       => 'fytinnovations.contacts::lang.plugin.name',
                'url'         => Backend::url('fytinnovations/contacts/contacts'),
                'icon'        => 'icon-address-book',
                'permissions' => ['fytinnovations.contacts.*'],
                'order'       => 500,
                'counter'     =>  $unReadMessageCount,
                'counterLabel' => 'fytinnovations.contacts::lang.messages.unread',
                'sideMenu'    => [
                    'contacts' => [
                        'label'       => 'fytinnovations.contacts::lang.contacts.menu_label',
                        'url'         => Backend::url('fytinnovations/contacts/contacts'),
                        'icon'        => 'icon-address-book',
                    ],
                    'messages' => [
                        'label'       => 'fytinnovations.contacts::lang.messages.menu_label',
                        'url'         => Backend::url('fytinnovations/contacts/messages'),
                        'icon'        => 'icon-envelope',
                        'counter'     =>  $unReadMessageCount,
                        'counterLabel' => 'fytinnovations.contacts::lang.messages.unread',
                    ]
                ]
            ],
        ];
    }

    public function registerMailTemplates()
    {
        return [
            'fytinnovations.contacts::mail.contact_form_submitted',
        ];
    }
}

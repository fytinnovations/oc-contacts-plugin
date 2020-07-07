<?php namespace Fytinnovations\Contacts\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use Flash;
use Lang;
use Fytinnovations\Contacts\Models\Contact;

/**
 * Contacts Back-end Controller
 */
class Contacts extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Fytinnovations.Contacts', 'contacts', 'contacts');
    }

    /**
     * Deleted checked contacts.
     */
    public function index_onDelete()
    {
        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {

            foreach ($checkedIds as $contactId) {
                if (!$contact = Contact::find($contactId)) continue;
                $contact->delete();
            }

            Flash::success(Lang::get('fytinnovations.contacts::lang.contacts.delete_selected_success'));
        }
        else {
            Flash::error(Lang::get('fytinnovations.contacts::lang.contacts.delete_selected_empty'));
        }

        return $this->listRefresh();
    }
}

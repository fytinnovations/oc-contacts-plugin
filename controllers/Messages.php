<?php

namespace Fytinnovations\Contacts\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use Flash;
use Fytinnovations\Contacts\Models\BackendUserMessageRead;
use Lang;
use Fytinnovations\Contacts\Models\Message;

/**
 * Messages Back-end Controller
 */
class Messages extends Controller
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

        BackendMenu::setContext('Fytinnovations.Contacts', 'contacts', 'messages');
    }

    /**
     * Deleted checked messages.
     */
    public function index_onDelete()
    {
        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {

            foreach ($checkedIds as $messageId) {
                if (!$message = Message::find($messageId)) continue;
                $message->delete();
            }

            Flash::success(Lang::get('fytinnovations.contacts::lang.messages.delete_selected_success'));
        } else {
            Flash::error(Lang::get('fytinnovations.contacts::lang.messages.delete_selected_empty'));
        }

        return $this->listRefresh();
    }

    public function preview($id)
    {
        BackendUserMessageRead::firstOrCreate(['message_id' => $id, 'backend_user_id' => $this->user->id]);
        return $this->asExtension('FormController')->preview($id);
    }
}

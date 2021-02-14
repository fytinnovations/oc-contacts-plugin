<?php

return [
    'plugin' => [
        'name' => 'Contacts',
        'description' => 'Manage contacts and receive messages from your users',
    ],
    'permissions' => [
        'some_permission' => 'Permission example',
    ],
    'contact' => [
        'name' => 'Name',
        'surname' => 'Surname',
        'email' => 'Email',
        'mobile' => 'Mobile',
        'new' => 'New Contact',
        'label' => 'Contact',
        'create_title' => 'Create Contact',
        'update_title' => 'Edit Contact',
        'preview_title' => 'Preview Contact',
        'list_title' => 'Manage Contacts',
    ],
    'contacts' => [
        'delete_selected_confirm' => 'Delete the selected Contacts?',
        'menu_label' => 'Contacts',
        'return_to_list' => 'Return to Contacts',
        'delete_confirm' => 'Do you really want to delete this Contact?',
        'delete_selected_success' => 'Successfully deleted the selected Contacts.',
        'delete_selected_empty' => 'There are no selected Contacts to delete.',
    ],
    'message' => [
        'name' => 'Name',
        'subject' => 'Subject',
        'email' => 'Email',
        'content' => 'Content',
        'new' => 'New Message',
        'label' => 'Message',
        'create_title' => 'Create Message',
        'update_title' => 'Edit Message',
        'preview_title' => 'Preview Message',
        'list_title' => 'Manage Messages',
        'is_read' => 'Is Read'
    ],
    'messages' => [
        'delete_selected_confirm' => 'Delete the selected Messages?',
        'menu_label' => 'Messages',
        'return_to_list' => 'Return to Messages',
        'delete_confirm' => 'Do you really want to delete this Message?',
        'delete_selected_success' => 'Successfully deleted the selected Messages.',
        'delete_selected_empty' => 'There are no selected Messages to delete.',
        'unread' => 'Unread Messages'
    ],
    'components' => [
        'contactform' => [
            'name' => 'Contact Form',
            'description' => 'Displays a page through which users can contact',
            'redirect_page' => 'Redirect Page',
            'redirect_page_desc' => 'Page to redirect when the message has been saved.',
            'success_message' => 'Success Message',
            'success_message_desc' => 'Message to display when the message has been successfully submitted.',
            'success_message_default' => 'Thankyou, for contacting us. We will get back to you soon.',
            'enable_email_notification' => 'Enable Email Notifications',
            'enable_email_notification_desc' => 'Notify administrators of the website upon submission.'
        ],
    ],
];

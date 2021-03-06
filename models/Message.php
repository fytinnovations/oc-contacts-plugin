<?php

namespace Fytinnovations\Contacts\Models;

use BackendAuth;
use Db;
use Model;

/**
 * Message Model
 */
class Message extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'fytinnovations_contacts_messages';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = ['content', 'subject'];

    /**
     * @var array Validation rules for attributes
     */
    public $rules = [
        'content' => 'required'
    ];

    /**
     * @var array Attributes to be cast to native types
     */
    protected $casts = [];

    /**
     * @var array Attributes to be cast to JSON
     */
    protected $jsonable = [];

    /**
     * @var array Attributes to be appended to the API representation of the model (ex. toArray())
     */
    protected $appends = [];

    /**
     * @var array Attributes to be removed from the API representation of the model (ex. toArray())
     */
    protected $hidden = [];

    /**
     * @var array Attributes to be cast to Argon (Carbon) instances
     */
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public $with = ['contact'];
    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [];
    public $belongsTo = [
        'contact' => Contact::class
    ];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

    /**Returns the name  of the contact who submitted the message */
    public function getNameAttribute()
    {
        return $this->contact->name;
    }

    /**Returns the name of the contact who submitted the message */
    public function getEmailAttribute()
    {
        return $this->contact->email;
    }

    public function scopeUnread($query, $user)
    {
        return $query->whereNotIn('id', function ($query) use ($user) {
            $query->select('message_id')
                ->from('fytinnovations_contacts_backend_user_message_reads')
                ->where('backend_user_id', $user->id);
        });
    }

    public function getIsReadAttribute()
    {
        return Db::table('fytinnovations_contacts_backend_user_message_reads')->where('message_id', $this->id)
            ->where('backend_user_id', BackendAuth::getUser()->id)
            ->exists();
    }
}

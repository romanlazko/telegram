<?php
namespace Romanlazko\Telegram\App\Entities;

use Romanlazko\Telegram\App\DB;
use Romanlazko\Telegram\App\Entities\BaseEntity;

class User extends BaseEntity
{
    public $expectation = null;

    public $referal = null;

    public static $map = [
        'id'                            => true,
        'is_bot'	                    => true,
        'first_name'	                => true,
        'last_name'	                    => true,
        'username'	                    => true,
        'language_code'	                => true,
        'is_premium'	                => true,
        'added_to_attachment_menu'	    => true,
        'can_join_groups'	            => true,
        'can_read_all_group_messages'	=> true,
        'supports_inline_queries'       => true,
    ];

    public function getExpectation()
    {
        if ($this->expectation === null) {
            $this->expectation = DB::getExpectation($this->getId());
        }
        return $this->expectation;
        
    }

    public function setExpectation($expectation = null)
    {
        $this->expectation = DB::setExpectation($this->getId(), $expectation);
    }
 
    public function setReferal($referal = null) : void
    {
        if (!$this->getReferal()) {
            $this->referal = DB::setReferal($this->getId(), $referal);
        }
    }

    public function getReferal()
    {
        if ($this->referal === null) {
            $this->referal = DB::getReferal($this->getId());
        }
        return $this->referal;
    }
}
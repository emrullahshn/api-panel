<?php

namespace App\Admin\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Blameable\Traits\BlameableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="ticket")
 * @ORM\HasLifecycleCallbacks()
 */
class Ticket
{
    use TimestampableEntity,
        BlameableEntity;

    public const STATUS_NEW = 'NEW';
    public const STATUS_WAITING = 'WAITING';
    public const STATUS_ANSWERED = 'ANSWERED';
    public const STATUS_CLOSED = 'CLOSED';

    public const STATUS_DESC = [
        self::STATUS_NEW => 'Yeni',
        self::STATUS_WAITING => 'Cevap Bekliyor',
        self::STATUS_ANSWERED => 'Cevaplandı',
        self::STATUS_CLOSED => 'Kapatıldı'
    ];

    public const DEPARTMENT_TECHNICAL = 10;
    public const DEPARTMENT_SALE = 20;
    public const DEPARTMENT_FINANCE = 30;

    public const DEPARTMENT_DESC = [
        self::DEPARTMENT_TECHNICAL => 'Teknik Destek',
        self::DEPARTMENT_SALE => 'Satış',
        self::DEPARTMENT_FINANCE => 'Muhasebe'
    ];

    public const DEPARTMENT_LIST = [
        'Teknik Destek' => self::DEPARTMENT_TECHNICAL,
        'Satış' => self::DEPARTMENT_SALE,
        'Muhasebe' => self::DEPARTMENT_FINANCE,
    ];

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(name="subject", type="string")
     */
    protected $subject;

    /**
     * @var int
     * @ORM\Column(name="department", type="integer")
     */
    protected $department;

    /**
     * @var string
     * @ORM\Column(name="status", type="string")
     */
    protected $status = self::STATUS_NEW;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="tickets")
     */
    protected $user;

    /**
     * @ORM\OneToMany(targetEntity="TicketMessage", mappedBy="ticket")
     */
    protected $messages;

    public function __construct()
    {
        $this->messages = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Ticket
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getSubject(): string
    {
        return $this->subject;
    }

    /**
     * @param string $subject
     * @return Ticket
     */
    public function setSubject(string $subject): Ticket
    {
        $this->subject = $subject;
        return $this;
    }

    /**
     * @return int
     */
    public function getDepartment(): int
    {
        return $this->department;
    }

    /**
     * @return string
     */
    public function getDepartmentDesc(): string
    {
        return self::DEPARTMENT_DESC[$this->department];
    }

    /**
     * @param int $department
     * @return Ticket
     */
    public function setDepartment(int $department): Ticket
    {
        $this->department = $department;
        return $this;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getStatusDesc(): string
    {
        return self::STATUS_DESC[$this->status];
    }

    /**
     * @param string $status
     * @return Ticket
     */
    public function setStatus(string $status): Ticket
    {
        $this->status = $status;
        return $this;
    }


    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     * @return Ticket
     */
    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMessages()
    {
        return $this->messages;
    }

    /**
     * @param mixed $messages
     * @return Ticket
     */
    public function setMessages($messages)
    {
        $this->messages = $messages;
        return $this;
    }

    /**
     * @param $message TicketMessage
     * @return $this
     */
    public function addMessage($message): self
    {
        $this->messages->add($message);

        return $this;
    }
}

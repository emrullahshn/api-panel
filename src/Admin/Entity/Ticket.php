<?php

namespace App\Admin\Entity;

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

    public const DEPARTMENT_TECHNICAL = 'TECHNICAL';
    public const DEPARTMENT_SALE = 'SALE';
    public const DEPARTMENT_FINANCE = 'FINANCE';

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
     * @var string
     * @ORM\Column(name="content", type="text")
     */
    protected $content;

    /**
     * @var string
     * @ORM\Column(name="answer", type="text", nullable=true)
     */
    protected $answer;

    /**
     * @var int
     * @ORM\Column(name="department", type="integer")
     */
    protected $department;

    /**
     * @var string
     * @ORM\Column(name="status", type="string")
     */
    protected $status;

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
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return Ticket
     */
    public function setContent(string $content): Ticket
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return string
     */
    public function getAnswer(): string
    {
        return $this->answer;
    }

    /**
     * @param string $answer
     * @return Ticket
     */
    public function setAnswer(string $answer): Ticket
    {
        $this->answer = $answer;
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
     * @param string $status
     * @return Ticket
     */
    public function setStatus(string $status): Ticket
    {
        $this->status = $status;
        return $this;
    }
}

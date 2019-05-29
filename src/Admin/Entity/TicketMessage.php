<?php


namespace App\Admin\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Blameable\Traits\BlameableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="ticket_message")
 * @ORM\HasLifecycleCallbacks()
 */
class TicketMessage
{
    use TimestampableEntity,
        BlameableEntity;

    public const STATUS_ADMIN = 1;
    public const STATUS_USER = 2;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Ticket", inversedBy="messages")
     */
    protected $ticket;

    /**
     * @var int
     * @ORM\Column(name="order_index", type="integer")
     */
    protected $orderIndex;

    /**
     * @var int
     * @ORM\Column(name="status", type="integer")
     */
    protected $status;

    /**
     * @var string
     * @ORM\Column(name=" message", type="text", nullable=true)
     */
    protected $message;

    /**
     * @var array|null
     * @ORM\Column(name="image_raw", type="json_array",nullable=true)
     */
    private $image_raw;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return TicketMessage
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTicket()
    {
        return $this->ticket;
    }

    /**
     * @param mixed $ticket
     * @return TicketMessage
     */
    public function setTicket($ticket)
    {
        $this->ticket = $ticket;
        return $this;
    }

    /**
     * @return int
     */
    public function getOrderIndex(): int
    {
        return $this->orderIndex;
    }

    /**
     * @param int $orderIndex
     * @return TicketMessage
     */
    public function setOrderIndex(int $orderIndex): TicketMessage
    {
        $this->orderIndex = $orderIndex;
        return $this;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     * @return TicketMessage
     */
    public function setStatus(int $status): TicketMessage
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $message
     * @return TicketMessage
     */
    public function setMessage(string $message): TicketMessage
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @return array|null
     */
    public function getImageRaw(): ?array
    {
        return $this->image_raw;
    }

    /**
     * @param array|null $image_raw
     * @return TicketMessage
     */
    public function setImageRaw(?array $image_raw): TicketMessage
    {
        $this->image_raw = $image_raw;
        return $this;
    }
}

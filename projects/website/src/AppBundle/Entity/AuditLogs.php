<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AuditLogs
 *
 * @ORM\Table(name="audit_logs", indexes={@ORM\Index(name="via", columns={"via"})})
 * @ORM\Entity
 */
class AuditLogs
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="record_type", type="string", length=255, nullable=false)
     */
    private $recordType;

    /**
     * @var integer
     *
     * @ORM\Column(name="record_id", type="integer", nullable=false)
     */
    private $recordId;

    /**
     * @var string
     *
     * @ORM\Column(name="action", type="string", length=255, nullable=false)
     */
    private $action;

    /**
     * @var string
     *
     * @ORM\Column(name="before", type="text", nullable=true)
     */
    private $before;

    /**
     * @var string
     *
     * @ORM\Column(name="after", type="text", nullable=true)
     */
    private $after;

    /**
     * @var integer
     *
     * @ORM\Column(name="created", type="integer", nullable=false)
     */
    private $created;

    /**
     * @var integer
     *
     * @ORM\Column(name="ip_address", type="integer", nullable=false)
     */
    private $ipAddress;

    /**
     * @var string
     *
     * @ORM\Column(name="reason", type="text", nullable=true)
     */
    private $reason;

    /**
     * @var integer
     *
     * @ORM\Column(name="via", type="integer", nullable=true)
     */
    private $via;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set recordType
     *
     * @param  string    $recordType
     * @return AuditLogs
     */
    public function setRecordType($recordType)
    {
        $this->recordType = $recordType;

        return $this;
    }

    /**
     * Get recordType
     *
     * @return string
     */
    public function getRecordType()
    {
        return $this->recordType;
    }

    /**
     * Set recordId
     *
     * @param  integer   $recordId
     * @return AuditLogs
     */
    public function setRecordId($recordId)
    {
        $this->recordId = $recordId;

        return $this;
    }

    /**
     * Get recordId
     *
     * @return integer
     */
    public function getRecordId()
    {
        return $this->recordId;
    }

    /**
     * Set action
     *
     * @param  string    $action
     * @return AuditLogs
     */
    public function setAction($action)
    {
        $this->action = $action;

        return $this;
    }

    /**
     * Get action
     *
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * Set before
     *
     * @param  string    $before
     * @return AuditLogs
     */
    public function setBefore($before)
    {
        $this->before = $before;

        return $this;
    }

    /**
     * Get before
     *
     * @return string
     */
    public function getBefore()
    {
        return $this->before;
    }

    /**
     * Set after
     *
     * @param  string    $after
     * @return AuditLogs
     */
    public function setAfter($after)
    {
        $this->after = $after;

        return $this;
    }

    /**
     * Get after
     *
     * @return string
     */
    public function getAfter()
    {
        return $this->after;
    }

    /**
     * Set created
     *
     * @param  integer   $created
     * @return AuditLogs
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return integer
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set ipAddress
     *
     * @param  integer   $ipAddress
     * @return AuditLogs
     */
    public function setIpAddress($ipAddress)
    {
        $this->ipAddress = $ipAddress;

        return $this;
    }

    /**
     * Get ipAddress
     *
     * @return integer
     */
    public function getIpAddress()
    {
        return $this->ipAddress;
    }

    /**
     * Set reason
     *
     * @param  string    $reason
     * @return AuditLogs
     */
    public function setReason($reason)
    {
        $this->reason = $reason;

        return $this;
    }

    /**
     * Get reason
     *
     * @return string
     */
    public function getReason()
    {
        return $this->reason;
    }

    /**
     * Set via
     *
     * @param  integer   $via
     * @return AuditLogs
     */
    public function setVia($via)
    {
        $this->via = $via;

        return $this;
    }

    /**
     * Get via
     *
     * @return integer
     */
    public function getVia()
    {
        return $this->via;
    }
}

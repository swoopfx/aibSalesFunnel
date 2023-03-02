<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="uploads")
 */
class Uploads {

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     *
     * @var string @ORM\Column(name="doc_name", type="string", length=200, nullable=true)
     */
    private $docName;

    /**
     *
     * @var string @ORM\Column(name="doc_url", type="string", length=500, nullable=true)
     */
    private $docUrl;

    // /**
    //  *
    //  * @var boolean @ORM\Column(name="is_confirmed", type="boolean", nullable=true)
    //  */
    // private $isConfirmed = '0';

    /**
     *
     * @var \DateTime @ORM\Column(name="created_on", type="datetime", length=100, nullable=true)
     */
    private $createdOn;

    /**
     *
     * @var \DateTime @ORM\Column(name="updated_on", type="datetime", length=100, nullable=true)
     */
    private $updatedOn;

    /**
     *
     * @var boolean @ORM\Column(name="is_hidden", type="boolean", nullable=true)
     */
    private $isHidden;

    /**
     *
     * @var string @ORM\Column(name="mime_type", type="string", length=100, nullable=true)
     */
    private $mimeType;

    /**
     *
     * @var string @ORM\Column(name="doc_ext", type="string", length=45, nullable=true)
     */
    private $docExt;

    /**
     *
     * @var string @ORM\Column(name="doc_code", type="string", length=100, nullable=true)
     */
    private $docCode;

    // /**
    //  *
    //  * @var \GeneralServicer\Entity\DocumentStatus @ORM\ManyToOne(targetEntity="GeneralServicer\Entity\DocumentStatus")
    //  *      @ORM\JoinColumns({
    //  *      @ORM\JoinColumn(name="doc_status", referencedColumnName="id")
    //  *      })
    //  */
    // private $docStatus;


    /**
     * Get @ORM\Column(name="id", type="integer", nullable=false)
     *
     * @return  integer
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get @ORM\Column(name="doc_name", type="string", length=200, nullable=true)
     *
     * @return  string
     */ 
    public function getDocName()
    {
        return $this->docName;
    }

    /**
     * Set @ORM\Column(name="doc_name", type="string", length=200, nullable=true)
     *
     * @param  string  $docName  @ORM\Column(name="doc_name", type="string", length=200, nullable=true)
     *
     * @return  self
     */ 
    public function setDocName(string $docName)
    {
        $this->docName = $docName;

        return $this;
    }

    /**
     * Get @ORM\Column(name="doc_url", type="string", length=500, nullable=true)
     *
     * @return  string
     */ 
    public function getDocUrl()
    {
        return $this->docUrl;
    }

    /**
     * Set @ORM\Column(name="doc_url", type="string", length=500, nullable=true)
     *
     * @param  string  $docUrl  @ORM\Column(name="doc_url", type="string", length=500, nullable=true)
     *
     * @return  self
     */ 
    public function setDocUrl(string $docUrl)
    {
        $this->docUrl = $docUrl;

        return $this;
    }

    /**
     * Get @ORM\Column(name="created_on", type="datetime", length=100, nullable=true)
     *
     * @return  \DateTime
     */ 
    public function getCreatedOn()
    {
        return $this->createdOn;
    }

    /**
     * Set @ORM\Column(name="created_on", type="datetime", length=100, nullable=true)
     *
     * @param  \DateTime  $createdOn  @ORM\Column(name="created_on", type="datetime", length=100, nullable=true)
     *
     * @return  self
     */ 
    public function setCreatedOn(\DateTime $createdOn)
    {
        $this->createdOn = $createdOn;
        $this->updatedOn = $createdOn;
        return $this;
    }

    /**
     * Get @ORM\Column(name="updated_on", type="datetime", length=100, nullable=true)
     *
     * @return  \DateTime
     */ 
    public function getUpdatedOn()
    {
        return $this->updatedOn;
    }

    /**
     * Set @ORM\Column(name="updated_on", type="datetime", length=100, nullable=true)
     *
     * @param  \DateTime  $updatedOn  @ORM\Column(name="updated_on", type="datetime", length=100, nullable=true)
     *
     * @return  self
     */ 
    public function setUpdatedOn(\DateTime $updatedOn)
    {
        $this->updatedOn = $updatedOn;

        return $this;
    }

    /**
     * Get @ORM\Column(name="is_hidden", type="boolean", nullable=true)
     *
     * @return  boolean
     */ 
    public function getIsHidden()
    {
        return $this->isHidden;
    }

    /**
     * Set @ORM\Column(name="is_hidden", type="boolean", nullable=true)
     *
     * @param  boolean  $isHidden  @ORM\Column(name="is_hidden", type="boolean", nullable=true)
     *
     * @return  self
     */ 
    public function setIsHidden(bool $isHidden)
    {
        $this->isHidden = $isHidden;

        return $this;
    }

    /**
     * Get @ORM\Column(name="mime_type", type="string", length=100, nullable=true)
     *
     * @return  string
     */ 
    public function getMimeType()
    {
        return $this->mimeType;
    }

    /**
     * Set @ORM\Column(name="mime_type", type="string", length=100, nullable=true)
     *
     * @param  string  $mimeType  @ORM\Column(name="mime_type", type="string", length=100, nullable=true)
     *
     * @return  self
     */ 
    public function setMimeType(string $mimeType)
    {
        $this->mimeType = $mimeType;

        return $this;
    }

    /**
     * Get @ORM\Column(name="doc_ext", type="string", length=45, nullable=true)
     *
     * @return  string
     */ 
    public function getDocExt()
    {
        return $this->docExt;
    }

    /**
     * Set @ORM\Column(name="doc_ext", type="string", length=45, nullable=true)
     *
     * @param  string  $docExt  @ORM\Column(name="doc_ext", type="string", length=45, nullable=true)
     *
     * @return  self
     */ 
    public function setDocExt(string $docExt)
    {
        $this->docExt = $docExt;

        return $this;
    }

    /**
     * Get @ORM\Column(name="doc_code", type="string", length=100, nullable=true)
     *
     * @return  string
     */ 
    public function getDocCode()
    {
        return $this->docCode;
    }

    /**
     * Set @ORM\Column(name="doc_code", type="string", length=100, nullable=true)
     *
     * @param  string  $docCode  @ORM\Column(name="doc_code", type="string", length=100, nullable=true)
     *
     * @return  self
     */ 
    public function setDocCode(string $docCode)
    {
        $this->docCode = $docCode;

        return $this;
    }
}

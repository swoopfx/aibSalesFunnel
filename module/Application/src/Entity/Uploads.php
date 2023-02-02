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

    /**
     *
     * @var boolean @ORM\Column(name="is_confirmed", type="boolean", nullable=true)
     */
    private $isConfirmed = '0';

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

}

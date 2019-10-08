<?php

namespace app\models\entity\sample;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Product
 *
 * @ORM\Table(name="product", indexes={@ORM\Index(name="name", columns={"name", "created"}), @ORM\Index(name="type", columns={"type"})})
 * @ORM\Entity
 */
class Product
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", precision=0, scale=0, nullable=false, options={"comment"="ID"}, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="type", type="integer", precision=0, scale=0, nullable=false, options={"comment"="分类"}, unique=false)
     */
    private $type;

    /**
     * @var string|null
     *
     * @ORM\Column(name="name", type="string", length=32, precision=0, scale=0, nullable=true, options={"comment"="名称"}, unique=false)
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="created", type="integer", precision=0, scale=0, nullable=false, options={"unsigned"=true,"comment"="生成时间"}, unique=false)
     */
    private $created;

    /**
     * @var string|null
     *
     * @ORM\Column(name="content", type="text", length=0, precision=0, scale=0, nullable=true, unique=false)
     */
    private $content;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="ctime", type="datetime", precision=0, scale=0, nullable=false, options={"default"="CURRENT_TIMESTAMP"}, unique=false)
     */
    private $ctime;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="utime", type="datetime", precision=0, scale=0, nullable=false, options={"default"="CURRENT_TIMESTAMP"}, unique=false)
     */
    private $utime;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set type.
     *
     * @param int $type
     *
     * @return Product
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type.
     *
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set name.
     *
     * @param string|null $name
     *
     * @return Product
     */
    public function setName($name = null)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string|null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set created.
     *
     * @param int $created
     *
     * @return Product
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created.
     *
     * @return int
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set content.
     *
     * @param string|null $content
     *
     * @return Product
     */
    public function setContent($content = null)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content.
     *
     * @return string|null
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set ctime.
     *
     * @param \DateTime $ctime
     *
     * @return Product
     */
    public function setCtime($ctime)
    {
        $this->ctime = $ctime;

        return $this;
    }

    /**
     * Get ctime.
     *
     * @return \DateTime
     */
    public function getCtime()
    {
        return $this->ctime;
    }

    /**
     * Set utime.
     *
     * @param \DateTime $utime
     *
     * @return Product
     */
    public function setUtime($utime)
    {
        $this->utime = $utime;

        return $this;
    }

    /**
     * Get utime.
     *
     * @return \DateTime
     */
    public function getUtime()
    {
        return $this->utime;
    }
}

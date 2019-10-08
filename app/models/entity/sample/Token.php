<?php

namespace app\models\entity\sample;

use Doctrine\ORM\Mapping as ORM;

/**
 * Token
 *
 * @ORM\Table(name="token")
 * @ORM\Entity
 */
class Token
{
    /**
     * @var string
     *
     * @ORM\Column(name="appid", type="string", length=16, precision=0, scale=0, nullable=false, options={"fixed"=true}, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $appid;

    /**
     * @var string|null
     *
     * @ORM\Column(name="secret", type="string", length=32, precision=0, scale=0, nullable=true, options={"fixed"=true}, unique=false)
     */
    private $secret;

    /**
     * @var string|null
     *
     * @ORM\Column(name="token", type="text", length=65535, precision=0, scale=0, nullable=true, unique=false)
     */
    private $token;

    /**
     * @var int
     *
     * @ORM\Column(name="create_time", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $createTime;

    /**
     * @var int|null
     *
     * @ORM\Column(name="refresh_time", type="integer", precision=0, scale=0, nullable=true, unique=false)
     */
    private $refreshTime;

    /**
     * @var int
     *
     * @ORM\Column(name="expire_in", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $expireIn;


    /**
     * Get appid.
     *
     * @return string
     */
    public function getAppid()
    {
        return $this->appid;
    }

    /**
     * Set secret.
     *
     * @param string|null $secret
     *
     * @return Token
     */
    public function setSecret($secret = null)
    {
        $this->secret = $secret;

        return $this;
    }

    /**
     * Get secret.
     *
     * @return string|null
     */
    public function getSecret()
    {
        return $this->secret;
    }

    /**
     * Set token.
     *
     * @param string|null $token
     *
     * @return Token
     */
    public function setToken($token = null)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get token.
     *
     * @return string|null
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set createTime.
     *
     * @param int $createTime
     *
     * @return Token
     */
    public function setCreateTime($createTime)
    {
        $this->createTime = $createTime;

        return $this;
    }

    /**
     * Get createTime.
     *
     * @return int
     */
    public function getCreateTime()
    {
        return $this->createTime;
    }

    /**
     * Set refreshTime.
     *
     * @param int|null $refreshTime
     *
     * @return Token
     */
    public function setRefreshTime($refreshTime = null)
    {
        $this->refreshTime = $refreshTime;

        return $this;
    }

    /**
     * Get refreshTime.
     *
     * @return int|null
     */
    public function getRefreshTime()
    {
        return $this->refreshTime;
    }

    /**
     * Set expireIn.
     *
     * @param int $expireIn
     *
     * @return Token
     */
    public function setExpireIn($expireIn)
    {
        $this->expireIn = $expireIn;

        return $this;
    }

    /**
     * Get expireIn.
     *
     * @return int
     */
    public function getExpireIn()
    {
        return $this->expireIn;
    }
}

<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Actions
 * @ORM\Entity
 * @ORM\Table(name="actions")
 */
class Actions
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    protected $title;

    /**
     * @var string
     *
     * @ORM\Column(name="action_name", type="string", length=255)
     */
    protected $action_name;

    /**
     * @var int
     *
     * @ORM\Column(name="user_id", type="integer", length=255)
     */
    protected $user_id;

    /**
     * @var string
     *
     * @ORM\Column(name="pattern_function", type="string", length=255)
     */
    protected $pattern_function;

    /**
     * @var int
     *
     * @ORM\Column(name="x", type="integer", length=255, nullable=true)
     */
    protected $x;

    /**
     * @var int
     *
     * @ORM\Column(name="y", type="integer", length=255, nullable=true)
     */
    protected $y;

    /**
     * @var int
     *
     * @ORM\Column(name="a", type="integer", length=255, nullable=true)
     */
    protected $a;

    /**
     * @var int
     *
     * @ORM\Column(name="b", type="integer", length=255, nullable=true)
     */
    protected $b;

    /**
     * @var int
     *
     * @ORM\Column(name="c", type="integer", length=255, nullable=true)
     */
    protected $c;

    /**
     * @var int
     *
     * @ORM\Column(name="result", type="integer", length=255, nullable=true)
     */
    protected $result;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set action name
     *
     * @param string $action_name
     *
     */
    public function setActionName($action_name)
    {
        $this->action_name = $action_name;

        return $this;
    }

    /**
     * Get action name
     *
     * @return string
     */
    public function getActionName()
    {
        return $this->action_name;
    }

    /**
     * Set userID
     *
     * @param integer $user_id
     *
     */
    public function setUserID($user_id)
    {
        $this->user_id = $user_id;

        return $this;
    }

    /**
     * Get userID
     *
     * @return integer
     */
    public function getUserID()
    {
        return $this->user_id;
    }

    /**
     * Set pattern function
     *
     * @param string $pattern_function
     *
     */
    public function setPatternFunction($pattern_function)
    {
        $this->pattern_function = $pattern_function;

        return $this;
    }

    /**
     * Get pattern function
     *
     * @return string
     */
    public function getPatternFunction()
    {
        return $this->pattern_function;
    }

    /**
     * Set result
     *
     * @param string $result
     *
     */
    public function setResult($result)
    {
        $this->result = $result;

        return $this;
    }

    /**
     * Get result
     *
     * @return string
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * Set x
     *
     * @param integer $x
     *
     */
    public function setX($x)
    {
        $this->x = $x;

        return $this;
    }

    /**
     * Get x
     *
     * @return integer
     */
    public function getX()
    {
        return $this->x;
    }

    /**
     * Set y
     *
     * @param integer $y
     *
     */
    public function setY($y)
    {
        $this->y = $y;

        return $this;
    }

    /**
     * Get y
     *
     * @return integer
     */
    public function getY()
    {
        return $this->y;
    }

    /**
     * Set a
     *
     * @param integer $a
     *
     */
    public function setA($a)
    {
        $this->a = $a;

        return $this;
    }

    /**
     * Get a
     *
     * @return integer
     */
    public function getA()
    {
        return $this->a;
    }

    /**
     * Set b
     *
     * @param integer $b
     *
     */
    public function setB($b)
    {
        $this->b = $b;

        return $this;
    }

    /**
     * Get b
     *
     * @return integer
     */
    public function getB()
    {
        return $this->b;
    }

    /**
     * Set c
     *
     * @param integer $c
     *
     */
    public function setC($c)
    {
        $this->c = $c;

        return $this;
    }

    /**
     * Get c
     *
     * @return integer
     */
    public function getC()
    {
        return $this->c;
    }
}

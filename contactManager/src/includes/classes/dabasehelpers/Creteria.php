<?php


/**
 * Classe permettant de representer
 * un crit�re de recherche
 *
 * @author Tarik BOUDAA
 *        
 */
class Creteria
{

    private $key;

    private $value;

    private $symbol;

    public function __construct($key, $val, $symbol)
    {
        $this->key = $key;
        $this->value = $val;
        $this->symbol = $symbol;
    }

    /**
     *
     * @return mixed
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     *
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     *
     * @return mixed
     */
    public function getSymbol()
    {
        return $this->symbol;
    }

    /**
     *
     * @param mixed $key
     */
    public function setKey($key)
    {
        $this->key = $key;
    }

    /**
     *
     * @param mixed $val
     */
    public function setValue($val)
    {
        $this->value = $val;
    }

    /**
     *
     * @param mixed $symbol
     */
    public function setSymbol($symbol)
    {
        $this->symbol = $symbol;
    }
}
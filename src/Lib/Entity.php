<?php

namespace Lib;
use RuntimeException;

class Entity extends RuntimeException {

    public function __call($methodName, $args) {

		try{

			if (preg_match('~^(set|get)([A-Z])(.*)$~', $methodName, $matches)) {
				$property = strtolower($matches[2]) . $matches[3];
				if (!property_exists($this, $property)) {
					throw new RuntimeException('Property ' . $property . ' not exists');
				}
				switch ($matches[1]) {
					case 'set':
						$this->checkArguments($args, 1, 1, $methodName);
						return $this->set($property, $args[0]);
					case 'get':
						$this->checkArguments($args, 0, 0, $methodName);
						return $this->get($property);
					case 'default':
						throw new RuntimeException('Method ' . $methodName . ' not exists');
				}
			}

		} catch(RuntimeException $e) {

			echo "Um erro ocorreu.<br />";
			echo "Número da linha: ".$e->getLine()."<br />";
			echo "Nome Do Arquivo: ".$e->getFile()."<br />";
			echo "Descrição do erro: ".$e->getMessage();
			exit();

		}
    }

    public function get($property) {
        return $this->$property;
    }

    public function set($property, $value) {
        $this->$property = $value;
        return $this;
    }

    protected function checkArguments(array $args, $min, $max, $methodName) {
        $argc = count($args);
        if ($argc < $min || $argc > $max) {
            throw new RuntimeException('Method ' . $methodName . ' needs minimaly ' . $min . ' and maximaly ' . $max . ' arguments. ' . $argc . ' arguments given.');
        }
    }

}

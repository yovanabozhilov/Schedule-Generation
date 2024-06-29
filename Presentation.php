<?php

namespace model;

class Presentation
{
    private $id;
    private $title;
    private $date;
    private $author;
    private $fn;
    private $hour;
    private $room;
	private $interests;

    public function __construct($id, $title, $date, $author, $fn, $hour, $room, $interests)
    {
        $this->id = $id;
        $this->title = $title;
        $this->date = $date;
        $this->author = $author;
        $this->fn = $fn;
        $this->hour = $hour;
        $this->room = $room;
		$this->interests = $interests;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }
	
    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function setAuthor($author)
    {
        $this->author = $author;
    }

    public function getFn()
    {
        return $this->fn;
    }

    public function setFn($fn)
    {
        $this->fn = $fn;
    }

    public function getHour()
    {
        return $this->hour;
    }

    public function setHour($hour)
    {
        $this->hour = $hour;
    }

    public function getRoom()
    {
        return $this->room;
    }

    public function setRoom($room)
    {
        $this->room = $room;
    }
	
	 public function getInterest() {
        return $this->interests;
    }

    public function setInterest($interests) {
        $this->interests = $interests;
    }
}

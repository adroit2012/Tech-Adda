<?php

class EventRepository
{
    /**
     * @var Sparrow
     */
    protected $db;

    public function __construct(Sparrow $db)
    {
        $this->db = $db;
    }

    public function getActiveEvents($order = 'ASC')
    {
        $this->db->from('events');
		$this->db->where('is_active = ', 1);
		$order ? $this->db->orderBy('event_id', $order) : "";
		return $this->db->many();
    }
	
	public function getEvents($criteria)
    {
		//if()
        return $this->db->from('events')
                    ->where('is_active = ', 1)
                    ->many();
    }

    public function getActiveEventsByCategory($categoryId)
    {
        return $this->db->from('events')
                    ->where('is_active = ', 1)
                    ->where('category_id = ', $categoryId)
                    ->many();
    }

    public function getEventById($eventId)
    {
        return $this->db->from('events')
                    ->where('event_id = ', $eventId)
                    ->one();
    }

    public function create($data)
    {
        $data['user_id'] = $_SESSION['user']['user_id'];

        $this->db->from('events')
             ->insert($data)
             ->execute();

        return $this->db->insert_id;
    }
}
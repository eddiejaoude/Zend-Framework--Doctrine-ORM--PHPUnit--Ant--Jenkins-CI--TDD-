<?php
/**
 * @Table(name="pages")
 * @Entity(repositoryClass="Default_Model_PageRepository")
 */
class Default_Model_Page {
	
	/**
     * @var integer $id
     * @Id @Column(type="integer") 
     * @GeneratedValue
     */
    private $id;

    /**
     * @var integer $layout
     * @Column(type="string")
     */
    private $layout;

    /**
     * @var string $name
     * @Column(type="string")
     */
    private $name;

    /**
     * @var string $title
     * @Column(type="string")
     */
    private $title;

    /**
     * @var string $slug
     * @Column(type="string")
     */
    private $slug;

    /**
     * @var string $options
     * @Column(type="integer")
     */
    private $content_id;
	
	/**
     * @var integer $user_id
     * @Column(type="integer")
     */
    private $user_id;
    
    /**
     * @var string $created_at
     * @Column(type="datetime")
     */
    private $created_at;

    /**
     * @var string $language
     * @Column(type="string")
     */
    private $language;
    
	/**
	 * @return the $id
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @return the $name
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @return the $title
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * @return the $slug
	 */
	public function getSlug() {
		return $this->slug;
	}

	/**
	 * @return the $content_id
	 */
	public function getContent_id() {
		return $this->content_id;
	}

	/**
	 * @return the $user_id
	 */
	public function getUser_id() {
		return $this->user_id;
	}

	/**
	 * @return the $created_at
	 */
	public function getCreated_at() {
		return $this->created_at;
	}

	/**
	 * @param integer $id
	 */
	public function setId($id) {
		$this->id = $id;
	}

	/**
	 * @param string $name
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * @param string $title
	 */
	public function setTitle($title) {
		$this->title = $title;
	}

	/**
	 * @param string $slug
	 */
	public function setSlug($slug) {
		$this->slug = $slug;
	}

	/**
	 * @param string $content_id
	 */
	public function setContent_id($content_id) {
		$this->content_id = $content_id;
	}

	/**
	 * @param integer $user_id
	 */
	public function setUser_id($user_id) {
		$this->user_id = $user_id;
	}

	/**
	 * @param string $created_at
	 */
	public function setCreated_at($created_at) {
		$this->created_at = $created_at;
	}

}

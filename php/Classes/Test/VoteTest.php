<?php

namespace RICJTech\Covid19Data\Test;

use RICJTech\Covid19Data\{Profile,Behavior, Business, Vote};
use Ramsey\Uuid\Uuid;
//use RICJTech\Covid19Data\DataTest;
use Faker;
//require_once(dirname(__DIR__) . "/Test/DataDesignTest.php");
// grab the class under scrutiny
require_once(dirname(__DIR__) . "/autoload.php");

// grab the uuid generator
require_once(dirname(__DIR__, 2) . "/lib/uuid.php");

class VoteTest extends DataDesignTest {
	private $profile = null;
	private $behavior = null;
	private $business= null;
	private $VALID_ACTIVATION_TOKEN;
	private $VALID_CLOUDINARY_ID ="astrongIdcloud";
	private $VALID_AVATAR_URL;
	private $VALID_PROFILE_EMAIL;
	private $VALID_PROFILE_HASH;
	private $VALID_PROFILE_PHONE ;
	private $VALID_PROFILE_USERNAME;
	private $VALID_VOTE_RESULT;
	private $VALID_VOTE_DATE;


	public function setUp(): void {
		parent::setUp();
		$faker = Faker\Factory::create();

		$password =$faker->password;
		$this->VALID_PROFILE_HASH = password_hash($password, PASSWORD_ARGON2I,["time_cost"=>45]);
		$this->VALID_ACTIVATION_TOKEN= bin2hex(random_bytes(16));
		$this->VALID_PROFILE_EMAIL = $faker->email;
		$this->VALID_PROFILE_PHONE = $faker->phoneNumber;
//		$this->VALID_CLOUDINARY_ID = "astrongIdcloud";
		$this->VALID_AVATAR_URL = $faker->url;
		$this->VALID_PROFILE_USERNAME = $faker->userName;
		$this->VALID_VOTE_DATE = $faker->dateTime;
		$this->VALID_VOTE_RESULT=true;

		// create and insert a Profile to own the report content
		$this->profile = new Profile(generateUuidV4()->toString(), $this->VALID_CLOUDINARY_ID, $this->VALID_AVATAR_URL,
			$this->VALID_ACTIVATION_TOKEN, $this->VALID_PROFILE_EMAIL,
			$this->VALID_PROFILE_HASH, $this->VALID_PROFILE_PHONE, $this->VALID_PROFILE_USERNAME);
		$this->profile->insert($this->getPDO());


		$this->business = new Business(generateUuidV4()->toString(), "myyelpid","123.456456", "128.789609", "RICJTECH","https://ricjtech.com");
		$this->business->insert($this->getPDO());

		$this->behavior = new Behavior(generateUuidV4()->toString(), $this->business->getBusinessId()->toString(),$this->profile->getProfileId()->toString(),"india", new \DateTime());
		$this->behavior->insert($this->getPDO());
	}
	public function testInsertValidVote(): void {
		//get count of profile records in db before we run the test
		$numRows = $this->getConnection()->getRowCount("vote");

		//insert a profile record in the db

		$vote = new Vote($this->behavior->getBehaviorId()->toString(), $this->profile->getProfileId()->toString(),$this->VALID_VOTE_RESULT,$this->VALID_VOTE_DATE);
		$vote->insert($this->getPDO());


		// grab the data from mySQL and enforce the fields match our expectations
		$results = Vote::getVotesByVoteProfileId ($this->getPDO(), $vote->getVoteProfileId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("vote"));
		$this->assertCount(1, $results);

		// grab the result from the array and validate it
		$pdoVote = $results[0];

		$this->assertEquals($pdoVote->getVoteProfileId(), $this->profile->getVoteProfileId());
		$this->assertEquals($pdoVote->getVoteResult(), $this->VALID_VOTE_RESULT);
		//format the date too seconds since the beginning of time to avoid round off error
		$this->assertEquals($pdoVote->getVoteDate()->getTimestamp(), $this->VALID_VOTE_DATE->getTimestamp());
	}


	public function testUpdateValidVote(): void{

	}
	public function testDeleteValidVote(): void{

	}

}


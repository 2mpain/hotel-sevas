<?php

namespace App\Models;

use Carbon\Carbon;
use Database\Factories\CustomerFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'middle_name',
        'email',
        'phoneNumber',
        'status',
        'feedbacks_count',
        'room_number',
        'arrival_date',
        'departure_date',
    ];

    protected static function newFactory()
    {
        return new CustomerFactory();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return self
     */
    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->first_name;
    }

    /**
     * @param string $firstName
     * @return self
     */
    public function setFirstName(string $firstName): self
    {
        $this->first_name = $firstName;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getMiddleName(): ?string
    {
        return $this->middle_name;
    }

    /**
     * @param string $middleName
     * @return self
     */
    public function setMiddleName(string $middleName): self
    {
        $this->middle_name = $middleName;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->last_name;
    }

    /**
     * @param string $lastName
     * @return self
     */
    public function setLastName(string $lastName): self
    {
        $this->last_name = $lastName;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return self
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    /**
     * @param string $phoneNumber
     * @return self
     */
    public function setPhoneNumber(string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;
        return $this;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     * @return self
     */
    public function setStatus(string $status): self
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getArrivalDate(): ?string
    {
        return $this->arrival_date;
    }

    /**
     * @param string $arrivalDate
     * @return self
     */
    public function setArrivalDate(string $arrivalDate): self
    {
        $this->arrival_date = $arrivalDate;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDepartureDate(): ?string
    {
        return $this->departure_date;
    }

    /**
     * @param string $departureDate
     * @return self
     */
    public function setDepartureDate(string $departureDate): self
    {
        $this->departure_date = $departureDate;
        return $this;
    }

    /**
     * @return int
     */
    public function getRoomNumber(): int
    {
        return $this->room_number;
    }

    /**
     * @param int $roomNumber 
     * @return self
     */
    public function setRoomNumber(int $roomNumber): self
    {
        $this->room_number = $roomNumber;
        return $this;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function room(): BelongsTo
    {
        return $this->belongsTo(HotelRoom::class, 'room_number');
    }
}

<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\LessonSlot;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Mario Rossi',
                'email' => 'mario.rossi@example.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Laura Bianchi',
                'email' => 'laura.bianchi@example.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Giovanni Verdi',
                'email' => 'giovanni.verdi@example.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Anna Ferrari',
                'email' => 'anna.ferrari@example.com',
                'password' => Hash::make('password'),
            ],
        ];

        $createdUsers = [];
        foreach ($users as $userData) {
            $createdUsers[] = User::create($userData);
        }

        // Recupera tutti gli slot disponibili con il conteggio delle prenotazioni esistenti
        $slots = $this->getSlotsAndCountConfirmedBookings();

        foreach ($createdUsers as $user) {
            // Ogni utente prenota da 1 a 4 lezioni
            $bookingsToCreate = rand(1, 4);
            $bookedSlots = [];

            for ($i = 0; $i < $bookingsToCreate; $i++) {
                // Ricarica il conteggio aggiornato
                $slots = $this->getSlotsAndCountConfirmedBookings();

                // Seleziona uno slot random che non è stato ancora prenotato da questo utente
                $availableSlots = $slots->filter(function ($slot) use ($bookedSlots) {
                    // Evita duplicati per lo stesso utente
                    if (in_array($slot->id, $bookedSlots)) 
                        return false;

                    // Verifica capacità usando il conteggio dal db
                    return ($slot->confirmed_bookings_count ?? 0) < $slot->max_students;
                });

                if ($availableSlots->isEmpty()) 
                    break;

                $slot = $availableSlots->random();
                $bookedSlots[] = $slot->id;

                // prenotazioni annullate (20%)
                $status = rand(1, 100) <= 20 ? 'cancelled' : 'confirmed';

                Booking::create([
                    'user_id' => $user->id,
                    'lesson_slot_id' => $slot->id,
                    'status' => $status,
                    'note' => rand(1, 100) <= 30 ? $this->getRandomNote() : null,
                ]);
            }
        }
    }

    private function getSlotsAndCountConfirmedBookings(): Collection
    {
        return LessonSlot::with('lesson')
            ->where('starts_at', '>', now())
            ->withCount(['bookings as confirmed_bookings_count' => function ($query) {
                $query->where('status', 'confirmed');
            }])
            ->get();
    }

    private function getRandomNote(): string
    {
        $notes = [
            'Ho bisogno di ripassare il brano X',
            'Prima lezione, sono principiante',
            'Vorrei concentrarmi sulla tecnica',
            'Preparazione per esame',
            'Portare spartito personalizzato',
            'Continuazione lezione precedente',
        ];

        return $notes[array_rand($notes)];
    }
}

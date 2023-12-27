<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bank;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bank::create([
            'id'=> 1,
            'name'=> 'Banesco, Banco Universal S.A.C.A.',
            'code'=> '0134',
            'created_by'=> 1
        ]);
        Bank::create([
            'id'=> 2,
            'name'=> 'Banco de Venezuela S.A.C.A. Banco Universal',
            'code'=> '0102',
            'created_by'=> 1
        ]);
        Bank::create([
            'id'=> 3,
            'name'=> 'Banco Mercantil, C.A. Banco Universal',
            'code'=> '0105',
            'created_by'=> 1
        ]);
        Bank::create([
            'id'=> 4,
            'name'=> 'Banco Provincial, S.A. Banco Universal',
            'code'=> '0108',
            'created_by'=> 1
        ]);
        
        Bank::create([
            'id'=> 5,
            'name'=> 'Venezolano de Crédito, S.A. Banco Universal',
            'code'=> '0104',
            'created_by'=> 1
        ]);

        Bank::create([
            'id'=> 6,
            'name'=> 'Bancaribe C.A. Banco Universal',
            'code'=> '0114',
            'created_by'=> 1
        ]);

        Bank::create([
            'id'=> 7,
            'name'=> 'Banco Exterior C.A. Banco Universal',
            'code'=> '0115',
            'created_by'=> 1
        ]);

        Bank::create([
            'id'=> 8,
            'name'=> 'Banco Occidental de Descuento, Banco Universal C.A.',
            'code'=> '0116',
            'created_by'=> 1
        ]);

        Bank::create([
            'id'=> 9,
            'name'=> 'Banco Caroní C.A. Banco Universal',
            'code'=> '0128',
            'created_by'=> 1
        ]);

        Bank::create([
            'id'=> 10,
            'name'=> 'Banco Nacional de Crédito, C.A. Banco Universal',
            'code'=> '0191',
            'created_by'=> 1
        ]);

        Bank::create([
            'id'=> 11,
            'name'=> 'Banco del Tesoro, C.A. Banco Universal',
            'code'=> '0163',
            'created_by'=> 1
        ]);

        Bank::create([
            'id'=> 12,
            'name'=> 'Banco Bicentenario, C.A. Banco Universal',
            'code'=> '0175',
            'created_by'=> 1
        ]);

        Bank::create([
            'id'=> 13,
            'name'=> 'Banco Sofitasa, Banco Universal',
            'code'=> '0137',
            'created_by'=> 1
        ]);

        Bank::create([
            'id'=> 14,
            'name'=> 'Banco Plaza, Banco Universal',
            'code'=> '0138',
            'created_by'=> 1
        ]);

        Bank::create([
            'id'=> 15,
            'name'=> 'Banco de la Gente Emprendedora C.A.',
            'code'=> '0166',
            'created_by'=> 1
        ]);

        Bank::create([
            'id'=> 16,
            'name'=> 'Banco Agrícola de Venezuela, C.A. Banco Universal',
            'code'=> '0177',
            'created_by'=> 1
        ]);

        Bank::create([
            'id'=> 17,
            'name'=> 'Banco Activo, C.A. Banco Universal',
            'code'=> '0171',
            'created_by'=> 1
        ]);
    }
}

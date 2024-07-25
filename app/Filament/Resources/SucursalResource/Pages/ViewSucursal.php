<?php

namespace App\Filament\Resources\SucursalResource\Pages;

use App\Filament\Resources\SucursalResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\SucursalResource\Pages;
use App\Filament\Resources\SucursalResource\RelationManagers;
use App\Models\Sucursal;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ViewSucursal extends ViewRecord
{
    protected static string $resource = SucursalResource::class;

    public  function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nro_sucursal')
                    ->numeric()
                    ->minValue(0)
                    ->required()
                    ->label('Número de Sucursal'),
                Forms\Components\Select::make('departamento')
                    ->options([
                        'Atlántida' => 'Atlántida',
                        'Colón' => 'Colón',
                        'Comayagua' => 'Comayagua',
                        'Copán' => 'Copán',
                        'Cortés' => 'Cortés',
                        'Choluteca' => 'Choluteca',
                        'El Paraíso' => 'El Paraíso',
                        'Francisco Morazán' => 'Francisco Morazán',
                        'Gracias a Dios' => 'Gracias a Dios',
                        'Intibucá' => 'Intibucá',
                        'Islas de la Bahía' => 'Islas de la Bahía',
                        'La Paz' => 'La Paz',
                        'Lempira' => 'Lempira',
                        'Ocotepeque' => 'Ocotepeque',
                        'Olancho' => 'Olancho',
                        'Santa Bárbara' => 'Santa Bárbara',
                        'Valle' => 'Valle',
                        'Yoro' => 'Yoro',
                    ])
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function (callable $set) {
                        $set('municipio', null);
                    })
                    ->label('Departamento'),
                Forms\Components\Select::make('municipio')
                    ->options(function (callable $get) {
                        $departamento = $get('departamento');
                        $municipios = [
                            'Atlántida' => ['La Ceiba', 'Tela', 'Jutiapa', 'La Masica', 'San Francisco', 'Arizona', 'Esparta'],
                            'Colón' => ['Trujillo', 'Tocoa', 'Bonito Oriental', 'Sabá', 'Sonaguera', 'Limón', 'Santa Fe', 'Iriona'],
                            'Comayagua' => ['Comayagua', 'Siguatepeque', 'La Libertad', 'Meámbar', 'Ojos de Agua', 'San Jerónimo', 'San José de Comayagua', 'San José del Potrero'],
                            'Copán' => ['Santa Rosa de Copán', 'La Entrada', 'Cabañas', 'Concepción', 'Copán Ruinas', 'Corquín', 'Cucuyagua', 'Dulce Nombre'],
                            'Cortés' => ['San Pedro Sula', 'Puerto Cortés', 'Choloma', 'La Lima', 'Villanueva', 'Omoa', 'Pimienta', 'Potrerillos', 'San Antonio de Cortés', 'San Francisco de Yojoa', 'San Manuel', 'Santa Cruz de Yojoa'],
                            'Choluteca' => ['Choluteca', 'Apacilagua', 'Concepción de María', 'Duyure', 'El Corpus', 'El Triunfo', 'Marcovia', 'Morolica', 'Namasigüe', 'Orocuina', 'Pespire', 'San Antonio de Flores', 'San Isidro', 'San José', 'San Marcos de Colón'],
                            'El Paraíso' => ['Yuscarán', 'Alauca', 'Danlí', 'El Paraíso', 'Guinope', 'Jacaleapa', 'Liure', 'Morocelí', 'Oropolí', 'Potrerillos', 'San Antonio de Flores', 'San Lucas', 'San Matías', 'Soledad', 'Teupasenti', 'Texiguat', 'Vado Ancho', 'Yauyupe', 'Trojes'],
                            'Francisco Morazán' => ['Tegucigalpa', 'Alubarén', 'Cedros', 'Curarén', 'El Porvenir', 'Guaimaca', 'La Libertad', 'La Venta del Sur', 'Lepaterique', 'Maraita', 'Marale', 'Nueva Armenia', 'Ojojona', 'Orica', 'Reitoca', 'Sabana Grande', 'San Antonio de Oriente', 'San Buenaventura', 'San Ignacio', 'San Juan de Flores', 'San Miguelito', 'Santa Ana', 'Santa Lucía', 'Talanga', 'Tatumbla', 'Valle de Ángeles', 'Villa de San Francisco', 'Vallecillo'],
                            'Gracias a Dios' => ['Puerto Lempira', 'Brus Laguna', 'Ahuas', 'Juan Francisco Bulnes', 'Ramón Villeda Morales', 'Wampusirpi'],
                            'Intibucá' => ['La Esperanza', 'Camasca', 'Colomoncagua', 'Concepción', 'Dolores', 'Intibucá', 'Jesús de Otoro', 'Magdalena', 'Masaguara', 'San Antonio', 'San Isidro', 'San Juan', 'San Marcos de la Sierra', 'San Miguelito', 'Santa Lucía', 'Yamaranguila'],
                            'Islas de la Bahía' => ['Roatán', 'Guanaja', 'José Santos Guardiola', 'Utila'],
                            'La Paz' => ['La Paz', 'Aguanqueterique', 'Cabañas', 'Cane', 'Chinacla', 'Guajiquiro', 'Lauterique', 'Marcala', 'Mercedes de Oriente', 'Opatoro', 'San Antonio del Norte', 'San José', 'San Juan', 'San Pedro de Tutule', 'Santa Ana', 'Santa Elena', 'Santa María', 'Santiago de Puringla', 'Yarula'],
                            'Lempira' => ['Gracias', 'Belén', 'Candelaria', 'Cololaca', 'Erandique', 'Gualcince', 'Guarita', 'La Campa', 'La Iguala', 'Las Flores', 'La Unión', 'La Virtud', 'Lepaera', 'Mapulaca', 'Piraera', 'San Andrés', 'San Francisco', 'San Juan Guarita', 'San Manuel Colohete', 'San Marcos de Caiquín', 'San Rafael', 'San Sebastián', 'Santa Cruz', 'Talgua', 'Tambla', 'Tomalá', 'Valladolid', 'Virginia'],
                            'Ocotepeque' => ['Nueva Ocotepeque', 'Belén Gualcho', 'Concepción', 'Dolores Merendón', 'Fraternidad', 'La Encarnación', 'La Labor', 'Lucerna', 'Mercedes', 'San Fernando', 'San Francisco del Valle', 'San Jorge', 'San Marcos', 'Santa Fe', 'Sensenti', 'Sinuapa'],
                            'Olancho' => ['Juticalpa', 'Campamento', 'Catacamas', 'Concordia', 'Dulce Nombre de Culmí', 'El Rosario', 'Esquipulas del Norte', 'Gualaco', 'Guarizama', 'Guata', 'Jano', 'La Unión', 'Mangulile', 'Manto', 'Salamá', 'San Esteban', 'San Francisco de Becerra', 'San Francisco de La Paz', 'Santa María del Real', 'Silca', 'Yocón'],
                            'Santa Bárbara' => ['Santa Bárbara', 'Arada', 'Atima', 'Azacualpa', 'Ceguaca', 'Chinda', 'Concepción del Norte', 'Concepción del Sur', 'El Níspero', 'Gualala', 'Ilama', 'Macuelizo', 'Naranjito', 'Nuevo Celilac', 'Petoa', 'Protección', 'Quimistán', 'San Francisco de Ojuera', 'San José de Colinas', 'San Luis', 'San Marcos', 'San Nicolás', 'San Pedro Zacapa', 'San Vicente Centenario', 'Santa Rita', 'Trinidad', 'Las Vegas'],
                            'Valle' => ['Nacaome', 'Alianza', 'Amapala', 'Aramecina', 'Caridad', 'Goascorán', 'Langue', 'San Francisco de Coray', 'San Lorenzo'],
                            'Yoro' => ['Yoro', 'Arenal', 'El Negrito', 'El Progreso', 'Jocón', 'Morazán', 'Olanchito', 'Santa Rita', 'Sulaco', 'Victoria', 'Yorito']
                        ];

                        return $municipios[$departamento] ?? [];
                    })
                    ->required()
                    ->label('Municipio')
                ,

                Forms\Components\Textarea::make('direccion_completa')
                    ->required()
                    ->maxlength(300)
                    ->label('Dirección Completa'),
                Forms\Components\TextInput::make('ciudad')
                    ->maxlength(300)
                    ->required()
                    ->label('Ciudad'),
                Forms\Components\Toggle::make('en_operacion')
                    ->required()
                    ->label('En Operación'),
            ]);
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}

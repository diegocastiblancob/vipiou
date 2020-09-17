<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\sale;
use App\credit;
use App\income;
use App\User;
use Illuminate\Support\Facades\DB;


class saleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //usuario logueado
        $user = Auth::user();
        $id = $user->id;

        $customers = User::find($id)->load('customer');
        $sales = DB::select('SELECT sales.id As sale_id, sale_target, sale_date, sale_description, sale_price, sale_credit, customers.name_customer, customers.lastname_customer FROM sales INNER JOIN customers on customer_id=customers.id WHERE customers.user_id=? ORDER BY sales.id DESC', [$id]);


        return view('sale', ['customers' => $customers->customer, 'sales' => $sales]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function indexsales()
    {
        //usuario logueado
        $user = Auth::user();
        $id = $user->id;

        //$customers = User::find($id)->load('customer');
        $sales = DB::select('SELECT sales.id As sale_id, sale_target, sale_date, sale_description, sale_price, sale_credit, customers.name_customer, customers.lastname_customer FROM sales INNER JOIN customers on customer_id=customers.id WHERE customers.user_id=? ORDER BY sales.id DESC', [$id]);

        return view('allsales', ['sales' => $sales]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show($id)
    {
        $sale = sale::find($id)->load('customer', 'credit');
        //print_r($sale);

        return view('showSale', ['sale' => $sale]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(Request $request)
    {
        //CHEC DE VALIDACION PARA FINANCIAMIENTO
        $sale_chec = $request->input('chec');
        //RECOGER DATOS DE FORMULRIO
        $id_customer = $request->input('id_customer');
        $sale_target = $request->input('sale_target');
        $sale_date = $request->input('sale_date');
        $sale_description = $request->input('sale_description');
        $sale_price = $request->input('sale_price');
        $initial_fee = $request->input('initial_fee');
        $no_fees = $request->input('no_fees');
        $field_price_array = $_REQUEST['field_price'];
        $field_date_array = $_REQUEST['field_date'];

        //cargar objrto
        $sale = new sale();
        $sale->customer_id = $id_customer;
        $sale->sale_target = $sale_target;
        $sale->sale_date = $sale_date;
        $sale->sale_description = $sale_description;
        $sale->sale_price = $sale_price;
        $sale->sale_file = '';

        //var_dump($sale_chec);die();
        if ($sale_chec) {
            $sale->sale_credit = 'SI';
            $sale->initial_fee = $initial_fee;
            $sale->no_fees = $no_fees;
            $sale->financed_price = $sale_price - $initial_fee;
            $sale->sale_status = 'PAGO';
            //guardar venta
            $sale->save();
            $id_sale = $sale->id;
            //guardar cuota inicial pagada en tabla crditos
            $credit = new credit();
            $credit->sale_id = $id_sale;
            $credit->no_fee = 'CUOTA INICIAL';
            $credit->statu_fee = 'PAGO';
            $credit->date_expiration_fee = $sale_date;
            $credit->price_fee = $initial_fee;
            $credit->save();
        } else {
            $sale->sale_credit = 'NO';
            $sale->initial_fee = $sale_price;
            $sale->no_fees = 0;
            $sale->financed_price = 0;
            $sale->sale_status = 'PAGO';
            //guardar venta
            $sale->save();
            $id_sale = $sale->id;
            //guardar venta de contado en tabla crditos
            $credit = new credit();
            $credit->sale_id = $id_sale;
            $credit->no_fee = 'VENTA DE CONTADO';
            $credit->statu_fee = 'PAGO';
            $credit->date_expiration_fee = $sale_date;
            $credit->price_fee = $sale_price;
            $credit->save();
        };

        if ($sale_chec){
            foreach ($field_price_array as $value => $item) {
                $fee_aux = $value+1;
                $fee = $value;
                $credit = new credit();
                $credit->sale_id = $id_sale;
                $credit->no_fee = 'Cuota '. $fee_aux;
                $credit->statu_fee = 'PENDIENTE';
                $credit->date_expiration_fee = $field_date_array[$fee];
                $credit->price_fee = $item;
                $credit->save();
            }
        }

        return redirect()->route('ventas')->with(['message' => 'Venta guardada correctemente']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function update(Request $request, $id)
    {
       
        //RECOGER DATOS DE FORMULRIO
        $sale_target = $request->input('sale_target');
        $sale_date = $request->input('sale_date');
        $sale_description = $request->input('sale_description');
        $sale_price = $request->input('sale_price');

        //cargar objrto
        $sale = sale::find($id);
        $sale->sale_target = $sale_target;
        $sale->sale_date = $sale_date;
        $sale->sale_description = $sale_description;
        $sale->sale_price = $sale_price;
        $sale->update();
        return redirect()->route('venta.detalle', ['id'=>$id]);
    }
}

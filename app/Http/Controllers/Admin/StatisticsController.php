<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Company;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class StatisticsController extends Controller
{
    public function index()
    {
        $companies = Company::all();

        return view('admin.statistics.index', compact('companies'));
    }

    public function barChartRevenueAndOrderNumber(Request $request)
    {
        //Recupero dei parametri che servono
        $companyId = $request->input('company');
        $from = $request->input('from');
        $to = $request->input('to');

        //Creazione della query
        $query = Order::query();

        //Filter per capire se ci è stata fornito un ristorante nella select altrimenti il grafico non funzionerà
        if ($companyId) {
            //Qui stiamo verificando che sono presenti dei piatti in ogni ordine, successivamente viene creata una funzione anonima ($q) per filtrare i piatti appartenenti al ristorante selezionato
            $query->whereHas('dishes', function ($q) use ($companyId) {
                $q->where('company_id', $companyId);
            });
        }

        //Filtraggio per data di inizio
        if ($from) {
            //Convertita la data in oggetto e impostata l'ora di inio a 00:00:00
            $fromDate = Carbon::parse($from)->startOfDay();
            //Una condizione che fa in modo che includa solo le date da quel giorno in poi
            $query->whereDate('created_at', '>=', $fromDate);
        }

        //Filtraggio per data di fine
        if ($to) {
            //Convertita la data in oggetto e impostata l'ora di fine a 23:59:59
            $toDate = Carbon::parse($to)->endOfDay();
            //Una condizione che fa in modo che includa solo le date fino a questo giorno 
            $query->whereDate('created_at', '<=', $toDate);
        }

        //Ritorno i risultati della query fatta in precedenza
        $orders = $query->get();

        //Creaziuone di un array vuoto per i dati delle compagnie
        $companyData = [];

        //Qui viene calcolato il numero totale di ordini
        $totalOrdersCount = $orders->count();

        //Converte le stringhe di data $from e $to in un oggetto carbon per rendere più semplice il confronto
        $fromDate = Carbon::parse($from);
        $toDate = Carbon::parse($to);

        //Calcola la differenza di giorni tra $from e $to
        $dateDiff = $fromDate->diffInDays($toDate);

        //Qui viene fatto il raggruppamento mensile se l'intervallo di giorno è compreso tra 30 e 365 giorni
        if ($dateDiff > 30 && $dateDiff <= 365) {
            $monthlyOrders = $orders->groupBy(function ($date) {
                return Carbon::parse($date->created_at)->format('Y-m');
            });
            $period = $fromDate->monthsUntil($toDate);
            foreach ($period as $month) {
                $monthFormat = $month->format('Y-m');
                $companyData[] = [
                    'period' => $monthFormat,
                    'total_orders' => $monthlyOrders->has($monthFormat) ? $monthlyOrders[$monthFormat]->sum('total') : 0,
                    'order_count' => $monthlyOrders->has($monthFormat) ? $monthlyOrders[$monthFormat]->count() : 0,
                ];
            }
        }

        //Qui viene fatto il raggruppamento giornaliero se l'intervallo di giorno è compreso tra 1 e 30 giorni
        elseif ($dateDiff <= 30) {
            $dailyOrders = $orders->groupBy(function ($date) {
                return Carbon::parse($date->created_at)->format('m-d');
            });
            $period = $fromDate->daysUntil($toDate);
            foreach ($period as $day) {
                $dayFormat = $day->format('m-d');
                $companyData[] = [
                    'period' => $dayFormat,
                    'total_orders' => $dailyOrders->has($dayFormat) ? $dailyOrders[$dayFormat]->sum('total') : 0,
                    'order_count' => $dailyOrders->has($dayFormat) ? $dailyOrders[$dayFormat]->count() : 0,
                ];
            }
        }

        //Qui viene fatto il raggruppamento annuale se l'intervallo di giorno è maggiore di 365 giorni
        elseif ($dateDiff > 365) {
            $yearlyOrders = $orders->groupBy(function ($date) {
                return Carbon::parse($date->created_at)->format('Y');
            });
            $period = $fromDate->yearsUntil($toDate);
            foreach ($period as $year) {
                $yearFormat = $year->format('Y');
                $companyData[] = [
                    'period' => $yearFormat,
                    'total_orders' => $yearlyOrders->has($yearFormat) ? $yearlyOrders[$yearFormat]->sum('total') : 0,
                    'order_count' => $yearlyOrders->has($yearFormat) ? $yearlyOrders[$yearFormat]->count() : 0,
                ];
            }
        }
        return response()->json(['companyData' => $companyData, 'totalOrdersCount' => $totalOrdersCount]);


    }

    public function totalRevenueTotalOrders(Request $request)
    {
        $userId = Auth::id();
        $userCompanies = Company::where('user_id', $userId)->pluck('id');
    
        $timePeriod = $request->input('timePeriod', 12);
        $startDate = now()->subMonths($timePeriod);
    
        $companyData = [];
    
        foreach ($userCompanies as $companyId) {
            $company = Company::find($companyId);
    
            $orders = Order::whereHas('dishes', function ($query) use ($companyId) {
                $query->where('company_id', $companyId);
            })->where('created_at', '>=', $startDate)->get();
    
            $totalRevenue = $orders->sum('total');
            $totalOrders = $orders->count();
    
            $companyData[] = [
                'company_id' => $company->id,
                'company_name' => $company->name,
                'total_revenue' => $totalRevenue,
                'total_orders' => $totalOrders,
            ];
        }
    
        return response()->json(['companyData' => $companyData]);
    }


}
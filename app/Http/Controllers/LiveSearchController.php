<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class LiveSearchController extends Controller
{
    public function index()
    {
        return view('livesearch');
    }

    public function show_data(Request $request)
    {
        $customer_search = $request->name;

        if ($customer_search != '') {
            $output = '';
            $data = DB::table('users')
                ->where('name', 'like', '%' . $customer_search . '%')
                ->orWhere('email', 'like', '%' . $customer_search . '%')
                ->orderBy('id', 'desc')
                ->get();

            $row_data = count($data);
            if ($row_data > 0) {
                foreach ($data as $key => $row) {
                    $output .= '<tr>
					         <td>' . $row->name . '</td>
					         <td>' . $row->email . '</td>
					        </tr>';
                }
            } else {
                $output .= '<tr>
		     	        <td align="center" colspan="5">No Data Found</td>
		     	       </tr>';
            }
            echo $output;
        }
    }
}

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
                ->orderBy('id', 'desc')->take(2)
                ->get();

            $output = '<ul class="dropdown-menu"style="display:block; position:relative">';

            foreach ($data as $row) {
                $output .= '<li><a href="#">' . $row->name . '</a></li>';
            }

            $output .= '</ul>';
            $output .= '<br>';
            $output .= '<br>';
            $output .= '<div>';

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

            $output .= '</div>';
            echo $output;
        }
    }
}

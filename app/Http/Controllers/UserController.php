namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function edit()
    {
        return view('profile.edit');
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'mobile' => 'required|string|max:15',
        ]);

        DB::statement('CALL UpdateUserProfile(?, ?, ?, ?, ?, ?)', [
            auth()->id(),
            $request->name,
            $request->address,
            $request->city,
            $request->date_of_birth,
            $request->mobile,
        ]);

        return redirect()->route('home')->with('success', 'Profiel bijgewerkt!');
    }
}

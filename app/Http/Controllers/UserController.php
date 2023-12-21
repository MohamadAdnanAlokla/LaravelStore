<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\Category;
use App\Models\Variation;
use App\Models\SystemSettings;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role_id', 2)->get();
        $setting = SystemSettings::first();
        return view('admin.users', compact('users','setting'));
    }


    

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'phone_number' => 'required',
            'gender' => 'required|in:male,female',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'birth' => 'nullable|date', // تحقق من صحة تاريخ الميلاد (اختياري)
        ]);
    
        $imagePath = null;
    
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('images', $imageName, 'public'); // حفظ الصورة في المجلد "public/images"
            $imagePath = 'images/' . $imageName; // تحديد المسار النسبي للصورة
        }
    
        User::create([
            'role_id' => 2,
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'phone_number' => $request->phone_number,
            'gender' => $request->gender,
            'image' => $imagePath,
            'birth' => $request->birth, // إضافة تاريخ الميلاد
        ]);
    
        return redirect()->route('users.index');
    }
     
    public function edit(User $user)
    {
        return view('admin.users_edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone_number' => 'required',
            'role' => 'required|in:1,2,3', // تحقق من القيم المقبولة للدور
            'gender' => 'required|in:male,female', // تحقق من القيم المقبولة للجنس
        ]);
    
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'role_id' => $request->role, // تحديث قيمة الدور
            'gender' => $request->gender, // تحديث قيمة الجنس
        ]);
    
        return redirect()->route('users.index');
    }
    

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index');
    }
}

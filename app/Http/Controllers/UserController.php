<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use stdClass;

use function PHPSTORM_META\type;

class UserController extends Controller
{
    public function index(Request $request)
    {
        // dd(Auth::user()->role === 'admin');
        if (Auth::user()->role === 'admin') {
            $users = User::orderby('created_at', 'desc')->paginate(10);
            return view('admin.index', compact('users'));
        }
        $books = Book::orderBy('created_at', 'desc')->paginate(10);

        return view('users.index', compact('books'));
    }


    public function show($var)
    {
        // dd(view('admin.allUsers',));
        if (Auth::user()->role === 'admin') {
            if ($var === 'all-users') {
                $users = User::orderby('created_at', 'desc')->paginate(10);
                return view('admin.allUsers', compact('users'));
            } elseif ($var === 'all-books') {
                $books = Book::orderby('created_at', 'desc')->paginate(10);
                return view('admin.allBooks', compact('books'));
            } elseif ($var === 'add-users') {
                return view('admin.addUsers');
            } elseif ($var === 'add-books') {
                return view('admin.addBooks');
            }
        }
        // return redirect()->route('user.dashboard');
    }

    public function store(Request $request)
    {
        if (Auth::user()->role === 'admin') {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users',
                'username' => 'required|string|unique:users|max:255',
                'password' => 'required|string|min:8|confirmed',
                'role' => 'required|string',
            ]);


            User::create($validated);

            return redirect()->route('admin.show', 'all-users')->with('success', 'New User added successfully');
        }
        return redirect()->route('home')->with('success', 'only admin can access route');
    }

    public function edit($id)
    {
        if (Auth::user()->role === 'admin') {
            $user = User::findOrFail($id);

            return view('admin.editUser', compact('user'));
        }

        return redirect()->route('home')->with('success', 'only admin can access route');
    }

    public function update(Request $request, $id)
    {
        if (Auth::user()->role === 'admin') {
            $validated =

                $request->validate([
                    'name' => 'required|string|max:255',
                    'email' => 'required|email',
                    'username' => 'required|string|max:255',
                    'password' => 'required|string|min:8|confirmed',
                    'role' => 'required|string',
                ]);

            $user = User::findOrFail($id);

            $user->update($validated);

            return redirect()->route('admin.show', 'all-users')->with('success', 'User Updated Successfully');
        }
        return redirect()->route('home')->with('success', 'only admin can access route');
    }

    public function delete($id)
    {
        if (Auth::user()->role === 'admin') {
            $user = User::findOrFail($id);

            $user->delete();

            return redirect()->route('admin.show', 'all-users')->with('success', 'User Deleted Successfully');
        }
        return redirect()->route('home')->with('success', 'only admin can access route');
    }

    public function search(Request $request)
    {
        $request->validate([
            'search' => 'min:3'
        ]);

        $search = $request->input('search');

        $books = Book::where('book_title', 'like', '%' . $search . '%')->get();

        // dd(gettype($search_results));

        return view('users.index', ['books' => $books, 'search' => $request->search]);
    }

    public function follow($userid, $followerid) {
        $user1 = User::findOrFail($userid);
        $user2 = User::findOrFail($followerid);
        $follower = 0;
        $following = 0;

        if($follower >= 0 && $following >= 0){
            $follower +=1;
            $following +=1;
        }

        $user1->update([
            'followers' => $follower
        ]);
        $user2->update([
            'following' =>$following
        ]);

        return redirect()->route('book.show', ['view-profile',$userid])->with('success', 'user followed');
    }

    public function unfollow($userid, $followerid)
    {
        $user1 = User::findOrFail($userid);
        $user2 = User::findOrFail($followerid);
        $follower = $user1->followers;
        $following = $user2->following;
        
        if ($follower >= 0 && $following >= 0) {
            $follower -= 1;
            $following -= 1;
        }
        $user1->update([
            'followers' => $follower
        ]);
        $user2->update([
            'following' => $following
        ]);
        
        return redirect()->route('book.show', ['view-profile', $userid])->with('success', 'user unfollowed');
    }

}

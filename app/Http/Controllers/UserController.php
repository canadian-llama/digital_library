<?php

namespace App\Http\Controllers;

use App\Events\FollowSystem;
use App\Events\NotificationSystem;
use App\Models\Book;
use App\Models\Comment;
use App\Models\Followers;
use App\Models\Following;
use App\Models\User;
use Illuminate\Auth\Events\Validated;
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
            return redirect()->route('admin-dashboard');
        }
        $books = Book::orderBy('created_at', 'desc')->paginate(10);

        return view('users.index', compact('books'));
    }


    public function show($name = 'admin', $var,)
    {
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
        } else {
            if ($var === 'view-profile') {
                $user = User::findOrFail(Auth::user()->id);
                // dd($user->followings);
                return view('users.profile', compact('user'));
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

            return redirect()->route('show', 'all-users')->with('success', 'New User added successfully');
        }
        return redirect()->route('home')->with('success', 'only admin can access route');
    }

    public function edit($var = 'admin', $id)
    {
        // dd($var);
        if (Auth::user()->role === 'admin' && $var === 'admin') {
            // dd('if');
            $user = User::findOrFail($id);

            return view('admin.editUser', compact('user'));
        } elseif (Auth::user()->role === 'user' && $var === 'user') {
            // dd('elseif');
            $user = User::findOrFail($id);
            return view('admin.editUser', compact('user'));
        } else {
            dd('else');
            return redirect()->route('home')->with('success', 'only admin can access route');
        }
    }

    public function update(Request $request, $var = 'admin', $id)
    {
        // dd(Auth::user()->role === 'admin' && $var === 'admin');
        if (Auth::user()->role === 'admin' && $var === 'admin') {
            dd('if');
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

            return redirect()->route('show', 'all-users')->with('success', 'User Updated Successfully');
        } elseif (Auth::user()->role === 'user' && $var === 'user') {
            $validated =

                $request->validate([
                    'name' => 'required|string|max:255',
                    'username' => 'required|string|max:255',
                    'password' => 'required|string|min:8|confirmed',
                ]);

            $user = User::findOrFail($id);

            $user->update($validated);

            return redirect()->route('show', 'all-users')->with('success', 'User Updated Successfully');
        }
        return redirect()->route('home')->with('success', 'only admin can access route');
    }

    public function delete($id)
    {
        if (Auth::user()->role === 'admin') {
            $user = User::findOrFail($id);

            $user->delete();

            return redirect()->route('show', 'all-users')->with('success', 'User Deleted Successfully');
        }
        return redirect()->route('home')->with('success', 'only admin can access route');
    }

    public function follow($userid, $followerid)
    {
        $followers = Followers::where('user_id', $followerid)->where('follower_id', $userid)->get();
        $followings = Following::where('user_id', $userid)->where('following_id', $followerid)->get();

        // dd((int)$followerid, Auth::user()->id);
        // dd(Auth::user()->followings->where((int)$followerid,Auth::user()->id));

        if ($followers->isEmpty() && $followings->isEmpty()) {
            event(new FollowSystem($userid, $followerid));
            return redirect()->route('book.show', ['view-profile', $userid])->with('success', 'user followed');
        } else {
            // dd('else');
            event(new FollowSystem($userid, $followerid));
            return redirect()->route('book.show', ['view-profile', $userid])->with('success', 'user unfollowed');
        }
    }

    public function comment(Request $request, $bookid)
    {
        $userid = Auth::user()->id;
        $username = Auth::user()->username;

        $validated = $request->validate([
            'comment' => 'required'
        ]);

        Comment::create([
            'user_id' => $userid,
            'book_id' => $bookid,
            'username' => $username,
            'comment' => $request->input('comment')
        ]);
        event(new NotificationSystem('You commented on book', Auth::user()->id, 'comment'));
        return redirect()->route('book.show', ['view-book-details', $bookid])->with('success', 'Commented');
    }

    public function reply(Request $request, $bookid)
    {
        $userid = Auth::user()->id;

        $validated = $request->validate([
            'comment' => 'required'
        ]);

        Comment::create([
            'user_id' => $userid,
            'book_id' => $bookid,
            'comment' => $request->input('comment')
        ]);
        return redirect()->route('book.show', ['view-book-details', $bookid])->with('success', 'Commented');
    }
}

@extends('layouts.admin')

@section('title', 'Admin Profile')

@section('content')
<div style="flex: 1; padding: 32px; overflow-y: auto;">
    <h1 style="font-size: 1.8rem; font-weight: 700; color: #e2e8f0; margin-bottom: 24px;">Admin Profile</h1>

    @if(session('success'))
    <div style="background: #10b981; color: white; padding: 12px 20px; border-radius: 12px; margin-bottom: 20px;">
        {{ session('success') }}
    </div>
    @endif

    <div style="background: #1e293b; border-radius: 16px; padding: 40px; box-shadow: 0 4px 12px rgba(0,0,0,0.2); max-width: 600px;">
        <div style="text-align: center; margin-bottom: 30px;">
            <div style="width: 100px; height: 100px; background: linear-gradient(135deg, #fd79a8, #f43f5e); border-radius: 50%; margin: 0 auto 15px; display: flex; align-items: center; justify-content: center; font-size: 2.5rem; color: white;">
                {{ auth()->user()->avatar ?? '👤' }}
            </div>
            <h2 style="color: #e2e8f0; font-size: 1.5rem; margin-bottom: 5px;">{{ auth()->user()->name }}</h2>
            <p style="color: #94a3b8;">{{ auth()->user()->email }}</p>
            <span style="background: #8b5cf6; color: white; padding: 4px 16px; border-radius: 20px; font-size: 0.85rem; font-weight: 600; display: inline-block; margin-top: 10px;">
                {{ auth()->user()->is_admin ? 'Administrator' : 'User' }}
            </span>
        </div>

        <form action="{{ route('admin.profile.update') }}" method="POST">
            @csrf
            <div style="margin-bottom: 20px;">
                <label style="display: block; color: #e2e8f0; margin-bottom: 8px; font-weight: 600;">Name</label>
                <input type="text" name="name" value="{{ auth()->user()->name }}" required style="width: 100%; padding: 12px; border-radius: 12px; border: 1px solid #334155; background: #0f172a; color: #e2e8f0; font-size: 1rem;">
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; color: #e2e8f0; margin-bottom: 8px; font-weight: 600;">Email</label>
                <input type="email" name="email" value="{{ auth()->user()->email }}" required style="width: 100%; padding: 12px; border-radius: 12px; border: 1px solid #334155; background: #0f172a; color: #e2e8f0; font-size: 1rem;">
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; color: #e2e8f0; margin-bottom: 8px; font-weight: 600;">Avatar Emoji (optional)</label>
                <input type="text" name="avatar" value="{{ auth()->user()->avatar }}" maxlength="10" placeholder="😊 or 🚀" style="width: 100%; padding: 12px; border-radius: 12px; border: 1px solid #334155; background: #0f172a; color: #e2e8f0; font-size: 1rem;">
            </div>

            <button type="submit" style="width: 100%; background: #10b981; color: white; border: none; padding: 14px; border-radius: 12px; font-weight: 600; font-size: 1.05rem; cursor: pointer;">
                <i class="fas fa-save"></i> Save Changes
            </button>
        </form>
    </div>
</div>
@endsection
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Perpustakaan')</title>
    <style>
        :root{font-family:Arial,sans-serif;color:#f2f2f2;background:#101010}*{box-sizing:border-box}body{margin:0;background:#101010}.shell{display:flex;min-height:100vh}.sidebar{width:230px;background:#050505;color:#fff;padding:28px 18px;border-right:1px solid #2b2b2b}.brand{font-size:22px;font-weight:700;margin:0 0 30px;color:#fff;text-decoration:none;display:block}.nav a{display:block;color:#bcbcbc;text-decoration:none;padding:11px 12px;border-radius:6px;margin:4px 0}.nav a:hover,.nav a.active{background:#9f1d25;color:#fff}.main{flex:1;padding:34px;max-width:1300px}.topbar{display:flex;justify-content:space-between;align-items:center;margin-bottom:24px}h1{margin:0;font-size:30px;color:#fff}h2{margin-top:0;color:#fff}.muted{color:#a6a6a6}.button{display:inline-block;background:#c62832;color:#fff;border:0;border-radius:5px;padding:10px 15px;text-decoration:none;cursor:pointer;font-size:14px}.button:hover{background:#e13a45}.button.secondary{background:#292929;color:#f4f4f4}.button.secondary:hover{background:#3b3b3b}.button.danger{background:#8e171f}.actions{display:flex;gap:8px;align-items:center}.panel{background:#181818;border:1px solid #303030;border-radius:8px;padding:22px;box-shadow:0 3px 12px #00000055}.table-wrap{overflow:auto}.table{width:100%;border-collapse:collapse}.table th,.table td{text-align:left;padding:14px 10px;border-bottom:1px solid #303030;white-space:nowrap}.table th{font-size:12px;text-transform:uppercase;color:#a6a6a6;letter-spacing:.04em}.table-photo{width:52px;height:52px;object-fit:cover;border-radius:6px;display:block;background:#292929}.table-photo-empty{width:52px;height:52px;border-radius:6px;background:#292929;color:#c62832;display:flex;align-items:center;justify-content:center;font-size:20px}.form-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:18px}.field{display:flex;flex-direction:column;gap:7px}.field.full{grid-column:1/-1}label{font-weight:600;font-size:14px;color:#f2f2f2}input,select{border:1px solid #444;border-radius:5px;padding:11px;font:inherit;background:#101010;color:#f2f2f2}input:focus,select:focus{border-color:#c62832;outline:2px solid #c6283233}.error{color:#ff6b73;font-size:13px}.detail{display:grid;grid-template-columns:180px 1fr;gap:13px}.detail dt{font-weight:700;color:#a6a6a6}.detail dd{margin:0}.flash{padding:12px 15px;background:#183b25;color:#9ee2b0;border-radius:5px;margin-bottom:18px}.flash.error{background:#45181b;color:#ff9da3}@media(max-width:760px){.shell{display:block}.sidebar{width:auto;border-right:0;border-bottom:1px solid #2b2b2b}.main{padding:20px}.form-grid{grid-template-columns:1fr}.detail{grid-template-columns:1fr}.topbar{gap:12px;align-items:flex-start;flex-direction:column}}
    </style>
</head>
<body>
<div class="shell">
    <aside class="sidebar">
        <a class="brand" href="{{ route('home') }}">Hindenburg</a>
        <nav class="nav">
            <a href="{{ route('members.index') }}">Member</a>
            <a href="{{ route('buku.index') }}">Buku</a>
            <a href="{{ route('kategori-buku.index') }}">Kategori</a>
        </nav>
    </aside>
    <main class="main">
        @if(session('success'))<div class="flash">{{ session('success') }}</div>@endif
        @if(session('error'))<div class="flash error">{{ session('error') }}</div>@endif
        @if($errors->any())<div class="flash error"><ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
        @yield('content')
    </main>
</div>
</body>
</html>

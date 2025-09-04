<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    <style>

    .dashboard-body{
background-color: #F5F5F5;
margin:0%;
padding:0%;
height:100%;
}

.navbar{
    padding:1rem 2rem;
    display:flex;
    align-items:center;
    width:100%;
    justify-content: space-between;
    box-shadow: 0 2px 4px 0 rgba(0,0,0,.1);
}

.logo{
    color:#424242;
    font-size:1.5rem;
}

.logo:hover{
    color:#2196F3;
    cursor: pointer;
}

.links{
     display:flex;
    width:50%;
    justify-content: space-evenly;
    text-decoration:none;
}

.links a{
    text-decoration:none;
    color:#424242;
}
.links a span{
    color:#2196F3;
}

.links a span:hover{
    color:#424242;
}

.links a:hover{
    text-decoration:none;
    color:#2196F3;
}

.home{
    width:100%;
    padding:1rem 2rem;
    width:100%;
    display:flex;
    flex-direction:column;
    justify-content: space-between;
}

h4{
    padding:2rem 2rem;
    box-shadow: 0 2px 4px 0 rgba(0,0,0,.1);
}

.dashboard-text{
    display:flex;
}

.search{
    display:flex;
    align-items:center;
}



    </style>
</head>
<body class="dashboard-body">
        <nav class="navbar">
        <div class="logo">
            FIMS
        </div>
        <div>
            <form action="" class="search">
                <input type="text"/>
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#1f1f1f"><path d="M784-120 532-372q-30 24-69 38t-83 14q-109 0-184.5-75.5T120-580q0-109 75.5-184.5T380-840q109 0 184.5 75.5T640-580q0 44-14 83t-38 69l252 252-56 56ZM380-400q75 0 127.5-52.5T560-580q0-75-52.5-127.5T380-760q-75 0-127.5 52.5T200-580q0 75 52.5 127.5T380-400Z"/></svg>
            </form>
        </div>
        <div class="links">
            <a href="/dashboard" class="">Overview</a>
            <a href="/admin-categories" class="">Families</a>
            <a href="" class="">Welcome <span>{{$name}}</span></a>
            <a href="/admin-logout" class="">Logout</a>
        </div>
        </nav>
        <div>
            <div class="home">
         <h3>Overview</h3>
         <div class="dashboard-text">
 <h4>Total Family count:{{$totalFamilies}} </h4>
        <h4>Total member count: {{$totalMembers}} </h4>
         </div>
       
            </div>
       
    </div>

</body>
</html>



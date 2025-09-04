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
    display: flex;
    flex-direction:column;
    align-items:center;
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
        <h4>
        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#1f1f1f"><path d="M185-80q-17 0-29.5-12.5T143-122v-105q0-90 56-159t144-88q-40 28-62 70.5T259-312v190q0 11 3 22t10 20h-87Zm147 0q-17 0-29.5-12.5T290-122v-190q0-70 49.5-119T459-480h189q70 0 119 49t49 119v64q0 70-49 119T648-80H332Zm148-484q-66 0-112-46t-46-112q0-66 46-112t112-46q66 0 112 46t46 112q0 66-46 112t-112 46Z"/></svg><br>    
        Total Family count:{{$totalFamilies}} 
         </h4>
        <h4>
            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#1f1f1f"><path d="M240-320q-33 0-56.5-23.5T160-400q0-33 23.5-56.5T240-480q33 0 56.5 23.5T320-400q0 33-23.5 56.5T240-320Zm480 0q-33 0-56.5-23.5T640-400q0-33 23.5-56.5T720-480q33 0 56.5 23.5T800-400q0 33-23.5 56.5T720-320Zm-240-40q-42 0-71-29t-29-71q0-42 29-71t71-29q42 0 71 29t29 71q0 42-29 71t-71 29ZM284-120q14-69 68.5-114.5T480-280q73 0 127.5 45.5T676-120H284Zm-204 0q0-66 47-113t113-47q17 0 32 3t29 9q-30 29-50 66.5T224-120H80Zm656 0q-7-44-27-81.5T659-268q14-6 29-9t32-3q66 0 113 47t47 113H736ZM88-480l-48-64 440-336 160 122v-82h120v174l160 122-48 64-392-299L88-480Z"/></svg><br> 
        Total member count: {{$totalMembers}} </h4>
         </div>
       
            </div>
       
    </div>

</body>
</html>



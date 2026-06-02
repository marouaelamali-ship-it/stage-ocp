<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<style>

body{
    font-family: DejaVu Sans;
    font-size:12px;
}

table{
    width:100%;
    border-collapse:collapse;
    margin-top:10px;
}

th,td{
    border:1px solid #000;
    padding:6px;
}

h1,h2{
    color:#0f172a;
}

</style>
</head>
<body>

<h1>RAPPORT GLOBAL OCP</h1>

<p>Date : {{ now()->format('d/m/Y H:i') }}</p>

<h2>Statistiques Générales</h2>

<table>
<tr>
    <th>Total Equipements</th>
    <th>Total Maintenances</th>
    <th>Total Interventions</th>
</tr>

<tr>
    <td>{{ $totalEquipments }}</td>
    <td>{{ $totalMaintenances }}</td>
    <td>{{ $totalInterventions }}</td>
</tr>
</table>

<h2>Statut des Maintenances</h2>

<table>
<tr>
    <th>Terminées</th>
    <th>En cours</th>
    <th>En attente</th>
</tr>

<tr>
    <td>{{ $terminees }}</td>
    <td>{{ $encours }}</td>
    <td>{{ $attente }}</td>
</tr>
</table>

<h2>Liste des Maintenances</h2>

<table>

<tr>
    <th>ID</th>
    <th>Equipement</th>
    <th>Type</th>
    <th>Statut</th>
    <th>Date</th>
</tr>

@foreach($maintenances as $m)

<tr>
    <td>{{ $m->id }}</td>
    <td>{{ $m->equipment->name ?? 'N/A' }}</td>
    <td>{{ $m->type }}</td>
    <td>{{ $m->status }}</td>
    <td>{{ $m->created_at }}</td>
</tr>

@endforeach

</table>

<h2>Liste des Interventions</h2>

<table>

<tr>
    <th>ID</th>
    <th>Maintenance</th>
    <th>Date début</th>
    <th>Date fin</th>
    <th>Rapport</th>
</tr>

@foreach($interventions as $i)

<tr>
    <td>{{ $i->id }}</td>
    <td>{{ $i->maintenance_id }}</td>
    <td>{{ $i->date_debut }}</td>
    <td>{{ $i->date_fin }}</td>
    <td>{{ $i->rapport }}</td>
</tr>

@endforeach

</table>

<h2>Liste des Equipements</h2>

<table>

<tr>
    <th>ID</th>
    <th>Nom</th>
    <th>Type</th>
    <th>Status</th>
</tr>

@foreach($equipments as $e)

<tr>
    <td>{{ $e->id }}</td>
    <td>{{ $e->name }}</td>
    <td>{{ $e->type }}</td>
    <td>{{ $e->status }}</td>
</tr>

@endforeach

</table>

<br><br>

<p>
OCP Maintenance Manager<br>
Rapport généré automatiquement.
</p>

</body>
</html>
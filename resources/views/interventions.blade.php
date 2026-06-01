<h1>Interventions</h1>

<form method="POST" action="/interventions">

@csrf

<select name="maintenance_id">

@foreach($maintenances as $m)

<option value="{{ $m->id }}">
Maintenance #{{ $m->id }}
</option>

@endforeach

</select>

<input
type="text"
name="technicien"
placeholder="Technicien">

<input
type="date"
name="date_intervention">

<select name="etat">

<option value="planifiee">
Planifiée
</option>

<option value="en cours">
En cours
</option>

<option value="terminee">
Terminée
</option>

</select>

<button>
Ajouter
</button>

</form>
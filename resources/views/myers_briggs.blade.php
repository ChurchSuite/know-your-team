@extends('layout')

@section('content')

<script>
	function myersBriggs() {
	return {
		fetchPeople() {
			let self = this;
			fetch('/api/data?test_identifier={{ $test_identifier }}')
				.then(res => res.json())
				.then(data => {
					data.forEach(p => {
						self.people.push(new Person(
							p.firstName,
							p.lastName,
							p.img,
							p.job,
							p.teams,
							[
								p.results.ie,
								p.results.sn,
								p.results.tf,
								p.results.jp,
							],
							p.uuid,
						))
					})
				})
		},

		focussedDivision: null,
		focussedPerson: null,
		focussedTeam: null,

		get teams() {
		let allTeams = this.people.map((person) => person.teams).flat();
		// return only unique teams
		return [...new Set(allTeams)];
		},

		people: [],
		view: "people",

		types: [
		{
			id: "INTJ",
			group: "Analysts",
			type: "INTJ-A / INTJ-T",
			name: "Architect",
			summary:
			"Imaginative and strategic thinkers, with a plan for everything",
		},
		{
			id: "INTP",
			group: "Analysts",
			type: "INTP-A / INTP-T",
			name: "Logician",
			summary:
			"Innovative inventors with an unquenchable thirst for knowledge.",
		},
		{
			id: "ENTJ",
			group: "Analysts",
			type: "ENTJ-A / ENTJ-T",
			name: "Commander",
			summary:
			"Bold, imaginative and strong-willed leaders, always finding a way - or making one.",
		},
		{
			id: "ENTP",
			group: "Analysts",
			type: "ENTP-A / ENTP-T",
			name: "Debater",
			summary:
			"Smart and curious thinkers who cannot resist an intellectual challenge.",
		},
		{
			id: "INFJ",
			group: "Diplomats",
			type: "INFJ-A / INFJ-T",
			name: "Advocate",
			summary:
			"Quiet and mystical, yet very inspiring and tireless idealists.",
		},
		{
			id: "INFP",
			group: "Diplomats",
			type: "INFP-A / INFP-T",
			name: "Mediator",
			summary:
			"Poetic, kind and alturistic people, always eager to help a good cause.",
		},
		{
			id: "ENFJ",
			group: "Diplomats",
			type: "ENFJ-A / ENFJ-T",
			name: "Protagonist",
			summary:
			"Charismatic and inspiring leaders, able to mesmerize their listeners.",
		},
		{
			id: "ENFP",
			group: "Diplomats",
			type: "ENFP-A / ENFP-T",
			name: "Campaigner",
			summary:
			"Enthusiastic, creative and sociable free spirits, who can always find a reason to smile.",
		},
		{
			id: "ISTJ",
			group: "Sentinels",
			type: "ISTJ-A / ISTJ-T",
			name: "Logistician",
			summary:
			"Practical and fact-minded individuals, whose reliability cannot be doubted.",
		},
		{
			id: "ISFJ",
			group: "Sentinels",
			type: "ISFJ-A / ISFJ-T",
			name: "Defender",
			summary:
			"Very dedicated and warm protectors, always ready to defend their loved ones.",
		},
		{
			id: "ESTJ",
			group: "Sentinels",
			type: "ESTJ-A / ESTJ-T",
			name: "Executive",
			summary:
			"Excellent administrators, unsurpassed at managing things - or people",
		},
		{
			id: "ESFJ",
			group: "Sentinels",
			type: "ESFJ-A / ESFJ-T",
			name: "Consul",
			summary:
			"Extraordinarily caring, social and popular people, always eager to help.",
		},
		{
			id: "ISTP",
			group: "Explorers",
			type: "ISTP-A / ISTP-T",
			name: "Virtuoso",
			summary:
			"Bold and practical experimenters, masters of all kinds of tools",
		},
		{
			id: "ISFP",
			group: "Explorers",
			type: "ISFP-A / ISFP-T",
			name: "Adventurer",
			summary:
			"Flexible and charming artists, always ready to explore and experience something new",
		},
		{
			id: "ESTP",
			group: "Explorers",
			type: "ESTP-A / ESTP-T",
			name: "Entrepreneur",
			summary:
			"Smart, energetic and very perceptive people, who truly enjoy living on the edge.",
		},
		{
			id: "ESFP",
			group: "Explorers",
			type: "ESFP-A / ESFP-T",
			name: "Entertainer",
			summary:
			"Spontaneous, energetic and enthusiastic people - life is never boring around them.",
		},
		],

		peopleInDivision() {
			// get types in division
			const divisionTypes = this.types
				.filter(type => type.group == this.focussedDivision)
				.map(type => type.id)

			// get people with types
			return this.people.filter(person => divisionTypes.includes(person.mbti.join('')))
		},

		peopleInTeam() {
		return this.people.filter((person) =>
			person.teams.includes(this.focussedTeam)
		);
		},

		setFocussedDivision(divisionName) {
		this.focussedDivision = divisionName;
		this.view = "division." + divisionName.toLowerCase();
		},

		setFocussedPerson(person) {
		this.focussedPerson = person;
		this.view = "person." + person.id;
		},

		setFocussedTeam(teamName) {
		this.focussedTeam = teamName;
		this.view = "team." + teamName;
		},

		setView(view) {
		if (view.startsWith("division")) {
			// go from "division.analysts" to just "analysts"
			let division = view.split(".").pop();
			// ucfirst the division
			division = division.charAt(0).toUpperCase() + division.slice(1);
			this.setFocussedDivision(division);
		} else if (view.startsWith("person")) {
			let personId = view.split(".").pop();

			this.setFocussedPerson(
			this.people.filter((person) => person.id === personId).pop()
			);
		} else if (view.startsWith("team")) {
			this.setFocussedTeam(view.substring(5));
		} else {
			this.view = view;
		}
		},

		typeCombo(person) {
		const mbti = person.mbti.join("");

		return this.types.filter((type) => type.id === mbti).pop();
		},
	};
	}

	class Person {
		constructor(firstName, lastName, img, jobTitle, teams, mbti, uuid) {
			this.firstName = firstName;
			this.lastName = lastName;
			this.img = img;
			this.jobTitle = jobTitle;
			this.teams = teams;
			this.mbti = mbti;
			this.uuid = uuid;
		}

		get id() {
			return this.firstName.substring(0, 4) + this.lastName.substring(0, 2);
		}

		get name() {
			return this.firstName + " " + this.lastName;
		}
	}
</script>


<div class="p-8 space-y-4" x-data="myersBriggs()" x-init="fetchPeople()">
    <h2 class="text-3xl font-bold tracking-tight text-gray-900">Myers Briggs</h2>
	<select @change="setView($el.value)" x-model="view" class="mb-4 w-full sticky top-0 rounded-md border-gray-300">
		<option value="people">Summary</option>
		<optgroup label="Divisions">
		  <option value="division.analysts">Analysts</option>
		  <option value="division.diplomats">Diplomats</option>
		  <option value="division.sentinels">Sentinels</option>
		  <option value="division.explorers">Explorers</option>
		</optgroup>
		<optgroup label="Teams">
		  <template x-for="team in teams" :key="team" hidden>
			<option :value="`team.${team}`" x-text="team"></option>
		  </template>
		</optgroup>
		<optgroup label="People">
		  <template x-for="person in people" :key="person.id" hidden>
			<option :value="`person.${person.id}`" x-text="person.name"></option>
		  </template>
		</optgroup>
	  </select>

	  <template x-if="view == 'people'">
		<!-- Grid of people -->
		<div class="grid grid-cols-2 gap-2 sm:grid-cols-3 sm:gap-3 md:grid-cols-4 md:fap-4 lg:grid-cols-5 xl:grid-cols-6">
		  <template x-for="person in people" hidden>
			<div
			  @click="setFocussedPerson(person)"
			  class="flex flex-col items-center justify-center h-60 shadow rounded space-y-2 hover:bg-gray-50 hover:shadow-md cursor-pointer"
			>
			  <img :src="person.img" class="rounded-full w-3/4 max-w-[9rem] aspect-square">
			  <p class="leading-6">
				<span x-text="person.firstName"></span>
				<span x-text="person.lastName"></span>
			  </p>
			  <div class="flex space-x-1">
				<template x-for="indicator in person.mbti">
				  <span class="rounded-md w-6 h-6 text-center text-gray-700 bg-gray-100" x-text="indicator"></span>
				</template>
			  </div>
			</div>
		  </template>
		</div>
	  </template>

	  <template x-if="view.startsWith('division')">
		<!-- Single division table -->
		<div class="space-y-4 py-6">
		  <h1 class="flex items-center text-2xl space-x-4">
			<span x-text="focussedDivision"></span>

		  </h1>

		  <div class="bg-green-100 text-green-700 gap-2 p-4 rounded-lg grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
			<template x-for="person in peopleInDivision()">
			  <a
				@click.prevent="setFocussedPerson(person)"
				class="flex space-x-2 items-center hover:text-green-800 hover:bg-green-200 rounded-full p-1 pr-2 w-full"
				href="#"
			  >
				<img :src="person.img" class="w-6 aspect-square rounded-full">
				<p class="leading-6 truncate" x-text="person.name"></p>
			  </a>
			</template>
		  </div>

		</div>
	  </template>

	  <template x-if="view.startsWith('person')">
		<!-- Single person focus-->
		<div class="py-4 space-y-4">
		  <!-- image -->
		  <div class="flex items-center space-x-6">
			<img :src="focussedPerson.img" class="h-16 w-16 rounded-full">
			<div>
			  <h1 class="font-bold text-2xl text-gray-900" x-text="focussedPerson.name"></h1>
			  <p class="text-gray-600" x-text="focussedPerson.jobTitle"></p>
			</div>
		  </div>
		  <a :href="'/submit?test_identifier=myers_briggs&user_uuid='+focussedPerson.uuid">Edit</a>
		  <div class="flex flex-row space-x-2">
			<template x-for="indicator in focussedPerson.mbti" hidden>
			  <a
				@click.prevent=""
				x-text="indicator"
				class="w-16 h-16 inline-flex items-center justify-center font-semibold rounded-md text-xl bg-gray-100 text-gray-700"
				href="#"
			  ></a>
			</template>
		  </div>
		  <div>
			<div class="flex flex-wrap gap-2">
			  <template x-for="team in focussedPerson.teams" hidden>
				<a
				  @click.prevent="setFocussedTeam(team)"
				  x-text="team"
				  class="rounded-full px-3 py-2 border border-blue-200 bg-blue-100 hover:bg-blue-200 text-blue-700"
				  href="#"
				></a>
			  </template>
			</div>
		  </div>
		  <!-- combo description -->
		  <div class="space-y-2">
			<p class="text-lg font-semibold" x-text="`${typeCombo(focussedPerson).name} (${typeCombo(focussedPerson).type})`"></p>
			<p class="text-base pl-4 border-l-4 border-gray-200 max-w-md" x-text="typeCombo(focussedPerson).summary"></p>
		  </div>
		</div>
	  </template>

	  <template x-if="view.startsWith('team')">
		<!-- Single team focus-->
		<div class="py-4 space-y-4">
		  <div class="flex items-center space-x-6">
			<h1 class="font-bold text-2xl text-gray-900" x-text="focussedTeam"></h1>
		  </div>
		  <div class="border-t border-gray-100"></div>
		  <!-- list of people with geniuses -->
		  <div class="space-y-2">
			<template x-for="person in peopleInTeam()" hidden>
			  <div class="flex space-x-4 items-center">
				<img :src="person.img" class="h-8 w-8 rounded-full">
				<a
				  @click.prevent="setFocussedPerson(person)"
				  x-text="person.name"
				  class="w-48 truncate"
				  href="#"
				></a>
				<div class="flex space-x-2">
				  <template x-for="indicator in person.mbti" hidden>
					<span class="w-6 h-6 bg-gray-100 text-gray-800 text-center rounded-md" x-text="indicator"></span>
				  </template>
				</div>
				</div>
			</template>
		  </div>
		</div>
	  </template>

	  </div>
</div>

<x-page-section>
</x-page-section>
@stop
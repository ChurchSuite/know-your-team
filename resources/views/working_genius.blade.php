@extends('layout')

@section('content')

<script>
	function workingGenius() {
		return {
			fetchPeople() {
				let self = this;
				fetch('/api/data?test_identifier={{ $test_identifier }}')
					.then(res => res.json())
					.then(data => {
						data.forEach(p => {
							self.people.push(new Person(
								p.firstName, //"Gavin",
								p.lastName, // "Courtney",
								p.img, // "https://cdn.churchsuite.com/Nr6TJr3e/addressbook/contacts/7_uj4pxwBT_thumb.jpg",
								p.job, // "Managing Director",
								p.teams, // ["Business", "Developer", "Support", "Marketing"],
								[
									p.results.genius1.charAt(0).toUpperCase()+p.results.genius1.substring(1), // "Invention",
									p.results.genius2.charAt(0).toUpperCase()+p.results.genius2.substring(1), // "Invention",
									p.results.competency1.charAt(0).toUpperCase()+p.results.competency1.substring(1), // "Invention",
									p.results.competency2.charAt(0).toUpperCase()+p.results.competency2.substring(1), // "Invention",
									p.results.frustration1.charAt(0).toUpperCase()+p.results.frustration1.substring(1), // "Invention",
									p.results.frustration2.charAt(0).toUpperCase()+p.results.frustration2.substring(1), // "Invention",
								]
							))
						})
					})
			},

			focussedGenius: null,
			focussedPerson: null,
			focussedTeam: null,
			geniusSet: [
				"Wonder",
				"Invention",
				"Discernment",
				"Galvanising",
				"Enablement",
				"Tenacity",
			],

			get teams() {
				let allTeams = this.people.map((person) => person.teams).flat();
				// return only unique teams
				return [...new Set(allTeams)];
			},

			people: [
			],
			view: "people",

			combos: [
				{
				combo: "WI",
				orderedCombo: "IW",
				name: "WI - Creative Dreamer",
				description:
					"Have a journal of ideas they have that they've never implemented. Walk around with a fount full of ideas in their head. Regardless of what they do they come up with creative ideas wherever they go. They come up with ideas, sometimes they're practical and sometimes they're not. They don't necessarily refine their ideas in order to make them practical. This person isn't typically suited to the main and plain, to routine jobs - they're looking for more than simply a process to follow.",
				},
				{
				combo: "WD",
				orderedCombo: "DW",
				name: "WD - Contemplative Counsellor",
				description:
					'Both someone who is "in their head" pondering and coming up with ideas, but also able to hear other people\'s ideas and helps them to discern them. Someone who might say "have you thought about this?" or "have you tried out...?". They can be a little hesitant and nuanced - they want to make sure that they\'ve really thought something through so that it\'s just right.',
				},
				{
				combo: "WG",
				orderedCombo: "GW",
				name: "WG - Philosophical Motivator",
				description:
					'Least frequent type found. Can explore a lot of different possibilities and gain a lot of excitement from different things in their life. They enjoy thinking big picture thoughts and they get energy from exploring those with others and then galvanising others around those ideas. Can be a little confusing as they are simultaneously saying "let\'s do it", but also "...but perhaps not". It can seem like they can communicate conflicting messages about the same thing - "let\'s get out there and take on that competitor" / "ooh, but they\'re very powerful and have great marketing, so maybe we shouldn\'t". Very thoughtful and really likely to encourage action.',
				},
				{
				combo: "WE",
				orderedCombo: "EW",
				name: "WE - Idealistic Supporter",
				description:
					"They think about things and if there's a cause they believe in, they'll do everything they can to support people involved in that cause. These people walk around and ask questions about what's possible based on their environment and then immediately respond to that. They can be easily overrun as they're responsive to their environment and then also responsive to the people around them. They might find themselves taking on too much as a result of this combo.",
				},
				{
				combo: "WT",
				orderedCombo: "TW",
				name: "WT - Careful Implementor",
				description:
					"They like to get stuff done, but they're also pretty careful and pretty cautious. Really deep thinker, but also deeply motivated. Living at both 50,000 feet and also 5 feet from the ground can leave them feeling pretty conflicted and torn; pulled between the clouds and the pavement. Bursts of energy (T) to get things done and then periods as they take a step back to assess where they're at and what they've done (W). Decision making and progress can lead to some angst and anxiety as they're nuanced about the direction. Can find themselves heading back to Wonder towards the end of a piece of work when Tenacity is required; this is a real challenge for them.",
				},
				{
				combo: "ID",
				orderedCombo: "DI",
				name: "ID - Discriminating Ideator",
				description:
					"Lots of new ideas, but really love vetting them internally - \"I have an idea, is it going to work?\". However, no inventor can truly vet their own ideas - a second person is required for feedback and to help discern those ideas. The rough draft is generally pretty good from these people - it's 80% of the way, but they still need to invite other people into the process to help them discern the ideas effectively. Not a lot of really bad drafts get through their internal filter, but they really struggle to fully refine their ideas and need to lean on others to help here. They can be very insitent in their ideas (since they've both invented and discerned them), so need strong characters around them as they can be difficult to disagree with.",
				},
				{
				combo: "IG",
				orderedCombo: "GI",
				name: "IG - Evangelising Innovator",
				description:
					"They're an innovator, but they have a strong \"sales\" side to them - they're excited about their ideas and that excitement is genuine! They love to get others excited about their ideas, they're born salespeople and motivators who evangelise their own ideas. If they've got an idea, you're going to hear about it - they don't write their ideas down in a journal, they tell others about them to see what sticks. They immediately start getting energy around their ideas, often ideas that they simply came up with that morning! Sometimes they can be hasty and too quick to move. They can also seem over the top and inauthentic - they can seem over eager to sell an idea. ",
				},
				{
				combo: "IE",
				orderedCombo: "EI",
				name: "IE - Adaptable Designer",
				description:
					"Come up with new ideas, but if there's an objection they're quick to say \"you don't like that? I'll tweak that for you, no problem\". Great at both new ideas and also customer service. Lots of new ideas, but not necessarily wedded to them, simply wants to serve their customers. Sometimes they can be too defferential and struggle to push their own idea when they sense it's the best one, leaning more into their E and choosing to make the customer happy. May not be the most proactive person since they're reactive to others.",
				},
				{
				combo: "IT",
				orderedCombo: "IT",
				name: "IT - Methodical Architect",
				description:
					"Very analytical and hard working. Someone with great and practical ideas that they're able to implement. Sometimes they can be overly analytical - \"I designed this, so this is the way it's going to work\", they can be overly wedded to the way they first envisaged something would be done. Nuance and flexibility are probably not their strength! Someone who has a lot of ideas... that they've already finished. Can find themselves having gotten to the end of the process before realising that they should really have refined the idea before they started working on it. Trial and error is how they explore the workability of things - they move straight from ideation to implementation, sometimes changing the implementation multiple times before they find the right fit (because they skipped the activation process). Less likely to ask for discernment because they're focussed on moving forward and getting to the end.",
				},
				{
				combo: "DG",
				orderedCombo: "DG",
				name: "DG - Intuitive Activator",
				description:
					"Good sense of what's a good idea very early in the process. They give confidence to others because they know that their judgement can be well trusted. Others know that if this person it trying to rally people around an idea, it's going to be a good one. As soon as they hear an idea that they're convinced is a good one, they immediately move towards galvanising people around that idea and getting them on board. They can be overly confident that they've got something right; \"rarely wrong, but never in doubt\". They can move too quickly, moving swiftly from D to G, which can be too fast for some others.",
				},
				{
				combo: "DE",
				orderedCombo: "DE",
				name: "DE - Insightful Collaborator",
				description:
					"Come alongside others saying \"I really want to help you, but before I do I'm going to ask some questions to make sure that it's actually what you need\". These people get asked to help a lot because they're quick to say \"yes\", but also because they can make sure that a process is well-formed before it begins. Sometimes they might find it hard to push back when they don't think something is a great idea, but they're afraid to tell you right away. They can find themselves taking on too much, having started with simply discerning an idea, they can quickly take on the burden of getting an idea into implementation. They need clear boundaries and guidance around whether they are being asked to Discern, Enable or both.",
				},
				{
				combo: "DT",
				orderedCombo: "DT",
				name: "DT - Judicious Accomplisher",
				description:
					"It's not just about getting stuff done, it about getting the right stuff done. These are very productive people; once they've decided that something is a good decision, they're all in and will crank through the work. They have one foot in activation and the other in implementation. Tenacity can carry a lot of weight in a person, so it's important for this person to make sure that they're choosing to discern first before they allow their tenacity to kick in. There's an angst in this person because they're both judging something but at the same time they really want to get it done. When someone's lazy, they can get pretty frustated at that person. They're really frustrated by inefficiency and things that are not done well.",
				},
				{
				combo: "GE",
				orderedCombo: "EG",
				name: "GE - Enthusiastic Encourager",
				description:
					"Positive, enthusiastic, affirming and life-giving people. These people thrive in roles like a fundraiser and relationship management - they bring real energy to helping others. They are ralliers, whipping up support and bringing people to action. They can, however, affirm too much, avoiding difficult feedback. They need to make sure that their encouragement is well-directed.",
				},
				{
				combo: "GT",
				orderedCombo: "GT",
				name: "GT - Assertive Driver",
				description:
					'"The butt kicker" - they love to get people on board and get it done right away. They get joy and energy by getting others on board with an idea, but then joining them in doing the hard work in order to get the thing done. They\'re a double disruptive type, but can feel very impatient and fast at times. They would be very frustrated in an environment where you have to be very defferential and do things "the right way". When they see someone who\'s not getting their work done, they\'re going to tell them. They can find themselves regularly bulldozing others, which can be helpful at times, but equally unhelpful too.',
				},
				{
				combo: "ET",
				orderedCombo: "ET",
				name: "ET - Loyal Finisher",
				description:
					"Immensely employable people - reliable, responsive to the needs, don't have to be managed hard in order to keep going. Incredibly valuable people, but they easily over-volunteer. They can get taken advantage of because they're responsive to the needs of others and then once they've responded, they're determined to see the task through to the end. The things they want to do can be overwhelming at times. They can over-stretch themselves and might well quit or get really sick before they tell you they have too much on their plate. They have extreme loyalty to the person who asked them to help with a task and then also to the process of seeing the task through to completion. It's easy not to give them the praise that they deserve, thinking \"that's just who they are\". People of this type can easily find themselves burning out as they're fully within the implementation phase - they need to be self aware to prevent this.",
				},
			],

			geniusCombo(person) {
				let personCombo = person
				.geniuses()
				.map((genius) => genius.substring(0, 1))
				.sort()
				.join("");

				return this.combos
				.filter((combo) => combo.orderedCombo == personCombo)
				.pop();
			},

			peopleInTeam() {
				return this.people.filter((person) =>
				person.teams.includes(this.focussedTeam)
				);
			},

			peopleWithCompetency(teamName, focussedGenius) {
				let people =
				typeof teamName !== "undefined" ? this.peopleInTeam() : this.people;
				focussedGenius =
				typeof focussedGenius !== "undefined"
					? focussedGenius
					: this.focussedGenius;

				return people.filter((person) =>
				person.competencies().includes(focussedGenius)
				);
			},

			peopleWithFrustration(teamName, focussedGenius) {
				let people =
				typeof teamName !== "undefined" ? this.peopleInTeam() : this.people;
				focussedGenius =
				typeof focussedGenius !== "undefined"
					? focussedGenius
					: this.focussedGenius;

				return people.filter((person) =>
				person.frustrations().includes(focussedGenius)
				);
			},

			peopleWithGenius(teamName, focussedGenius) {
				let people =
				typeof teamName !== "undefined" ? this.peopleInTeam() : this.people;
				focussedGenius =
				typeof focussedGenius !== "undefined"
					? focussedGenius
					: this.focussedGenius;

				return people.filter((person) =>
				person.geniuses().includes(focussedGenius)
				);
			},

			setFocussedGenius(geniusName) {
				this.focussedGenius = geniusName;
				this.view = "genius." + geniusName.toLowerCase();
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
				if (view.startsWith("genius")) {
				// go from "genius.wonder" to just "wonder"
				let genius = view.split(".").pop();
				// ucfirst the genius
				genius = genius.charAt(0).toUpperCase() + genius.slice(1);
				this.setFocussedGenius(genius);
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
		};
	}

	class Person {
		// constructor(firstName, lastName, img, allGeniuses, jobTitle, teams) {
		constructor(firstName, lastName, img, jobTitle, teams, allGeniuses) {
			this.firstName = firstName;
			this.lastName = lastName;
			this.img = img;
			this.allGeniuses = allGeniuses;
			this.jobTitle = jobTitle;
			this.teams = teams;
		}

		competencies() {
			return this.allGeniuses.slice(2, 4);
		}

		frustrations() {
			return this.allGeniuses.slice(4, 6);
		}

		geniuses() {
			return this.allGeniuses.slice(0, 2);
		}

		get id() {
			return this.firstName.substring(0, 4) + this.lastName.substring(0, 2);
		}

		get name() {
			return this.firstName + " " + this.lastName;
		}
	}
</script>


<div x-data="workingGenius" x-init="fetchPeople">
		<select @change="setView($el.value)" x-model="view" class="mb-4 w-full sticky top-0 rounded-md border-gray-300">
		  <option value="people">Home</option>
		  <optgroup label="Geniuses">
			<option value="genius.wonder">Wonder</option>
			<option value="genius.invention">Invention</option>
			<option value="genius.discernment">Discernment</option>
			<option value="genius.galvanising">Galvanising</option>
			<option value="genius.enablement">Enablement</option>
			<option value="genius.tenacity">Tenacity</option>
		  </optgroup>
		  <!-- <optgroup label="Phases">
			<option value="phase.ideation">Ideation</option>
			<option value="phase.activation">Activation</option>
			<option value="phase.implementation">Implementation</option>
		  </optgroup> -->
		  <!-- disruptive/responsive -->
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
				  <template x-for="genius in geniusSet" hidden>
					<a
					  @click.stop="setFocussedGenius(genius)"
					  x-text="genius[0]"
					  class="rounded-md w-6 h-6 text-center"
					  :class="{
						'text-green-700 bg-green-100': person.geniuses().includes(genius),
						'text-gray-700 bg-gray-100': person.competencies().includes(genius),
						'text-red-700 bg-red-100': person.frustrations().includes(genius),
					  }"
					  href="#"
					></div>
				  </template>
				</div>
			  </div>
			</template>
		  </div>
		</template>

		<template x-if="view.startsWith('genius')">
		  <!-- Single genius table -->
		  <div class="space-y-4 py-6">
			<h1 class="flex items-center text-2xl space-x-4">
			  <span x-text="focussedGenius"></span>
			  <div class="text-sm">
				<span x-text="peopleWithGenius().length" class="bg-green-100 text-green-700 w-6 h-6 rounded items-center justify-center inline-flex"></span>
				<span x-text="peopleWithCompetency().length" class="bg-gray-100 text-gray-700 w-6 h-6 rounded items-center justify-center inline-flex"></span>
				<span x-text="peopleWithFrustration().length" class="bg-red-100 text-red-700 w-6 h-6 rounded items-center justify-center inline-flex"></span>
			  </div>
			</h1>
			<div class="bg-green-100 text-green-700 gap-2 p-4 rounded-lg grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
			  <template x-for="person in peopleWithGenius()">
				<a
				  @click.prevent="setFocussedPerson(person)"
				  class="flex space-x-2 items-center hover:text-green-800 hover:bg-green-200 rounded-full p-1 pr-2"
				  href="#"
				>
				  <img :src="person.img" class="w-6 aspect-square rounded-full">
				  <p class="leading-6 truncate" x-text="person.name"></p>
				</a>
			  </template>
			</div>
			<div class="bg-gray-100 text-gray-700 gap-2 p-4 rounded-lg grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
			  <template x-for="person in peopleWithCompetency()">
				<a
				  @click.prevent="setFocussedPerson(person)"
				  class="flex space-x-2 items-center hover:text-gray-800 hover:bg-gray-200 rounded-full p-1 pr-2 w-full"
				  href="#"
				>
				  <img :src="person.img" class="w-6 aspect-square rounded-full">
				  <p class="leading-6 truncate" x-text="person.name"></p>
				</a>
			  </template>
			</div>
			<div class="bg-red-100 text-red-700 gap-2 p-4 rounded-lg grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
			  <template x-for="person in peopleWithFrustration()">
				<a
				  @click.prevent="setFocussedPerson(person)"
				  class="flex space-x-2 items-center hover:text-red-800 hover:bg-red-200 rounded-full p-1 pr-2 w-full"
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
			<div class="flex flex-row space-x-2">
			  <template x-for="genius in geniusSet" hidden>
				<a
				  @click.prevent="setFocussedGenius(genius)"
				  x-text="genius[0]"
				  class="w-16 h-16 inline-flex items-center justify-center font-semibold rounded-md text-xl"
				  :class="{
					'text-green-700 bg-green-100 hover:bg-green-200': focussedPerson.geniuses().includes(genius),
					'text-gray-700 bg-gray-100 hover:bg-gray-200': focussedPerson.competencies().includes(genius),
					'text-red-700 bg-red-100 hover:bg-red-200': focussedPerson.frustrations().includes(genius),
				  }"
				  href="#"
				></a>
			  </template>
			</div>
			<div class="flex flex-row space-x-2">
			  <template x-for="(genius, i) in focussedPerson.allGeniuses" hidden>
				<a
				  @click.prevent="setFocussedGenius(genius)"
				  x-text="genius[0]"
				  class="w-16 h-16 inline-flex items-center justify-center font-semibold rounded-md text-xl"
				  :class="{
					'text-green-700 bg-green-100 hover:bg-green-200': [0,1].includes(i),
					'text-gray-700 bg-gray-100 hover:bg-gray-200': [2,3].includes(i),
					'text-red-700 bg-red-100 hover:bg-red-200': [4,5].includes(i),
				  }"
				  href="#"
				></a>
			  </template>
			</div>
			<!-- distance between -->
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
			  <p class="text-lg font-semibold" x-text="geniusCombo(focussedPerson).name"></p>
			  <p class="text-base pl-4 border-l-4 border-gray-200 max-w-md" x-text="geniusCombo(focussedPerson).description"></p>
			</div>
		  </div>
		</template>

		<template x-if="view.startsWith('team')">
		  <!-- Single team focus-->
		  <div class="py-4 space-y-4">
			<div class="flex items-center space-x-6">
			  <h1 class="font-bold text-2xl text-gray-900" x-text="focussedTeam"></h1>
			</div>
			<!-- each genius with its results -->
			<div class="space-y-2">
			  <template x-for="genius in geniusSet" hidden>
				<div class="flex space-x-4 h-8 items-center">
				  <!-- <p class="ml-12 w-48 truncate shrink-0" x-text="genius"></p> -->
				  <a
					@click.prevent="setFocussedGenius(genius)"
					x-text="genius"
					class="w-48 truncate shrink-0"
					href="#"
				  ></a>

				  <div class="text-base space-x-1">
					<span x-text="peopleWithGenius(focussedTeam, genius).length" class="bg-green-100 text-green-700 w-6 h-6 rounded items-center justify-center inline-flex"></span>
					<span x-text="peopleWithCompetency(focussedTeam, genius).length" class="bg-gray-100 text-gray-700 w-6 h-6 rounded items-center justify-center inline-flex"></span>
					<span x-text="peopleWithFrustration(focussedTeam, genius).length" class="bg-red-100 text-red-700 w-6 h-6 rounded items-center justify-center inline-flex"></span>
				  </div>
				</div>
			  </template>
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
					<template x-for="genius in geniusSet" hidden>
					  <a
						@click.stop="setFocussedGenius(genius)"
						x-text="genius[0]"
						class="rounded-md w-6 h-6 text-center"
						:class="{
						  'text-green-700 bg-green-100': person.geniuses().includes(genius),
						  'text-gray-700 bg-gray-100': person.competencies().includes(genius),
						  'text-red-700 bg-red-100': person.frustrations().includes(genius),
						}"
						href="#"
					  ></a>
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
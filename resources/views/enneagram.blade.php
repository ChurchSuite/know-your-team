@extends('layout')

@section('content')
  <script>
	function enneagram() {
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
								{
									number: parseInt(p.results.type),
									wing: parseInt(p.results.wing),
								},
								p.uuid,
							))
						})
					})
			},

			focussedType: null,
			focussedPerson: null,
			focussedTeam: null,

			get teams() {
				let allTeams = this.people.map((person) => person.teams).flat();
				// return only unique teams
				return [...new Set(allTeams)];
			},

			// @todo fetch() people from endpoint
			people: [],
			view: "people",

			types: [
				{
					name: "The Reformer",
					number: 1,
					triad: "gut",
					summary:
						"The Rational, Idealistic Type: Principled, Purposeful, Self-Controlled, and Perfectionistic",
					wings: [
						{
							number: 9,
							description:
								"An enneagram 1w9 will tend to be more introverted than a 1w2. You think before you speak to avoid saying something that goes against your morals. Sometimes you take so long to think that you can be a bit of a procrastinator. This wing type is better at maintaining relationships.",
						},
						{
							number: 2,
							description:
								"An enneagram 1w2 tends to be extroverted and outgoing with a warm nature. You are more empathetic and understanding than a 1w2 and feel inclined to help the people around you. You’re an excellent problem-solver, but you also can be a little more critical and controlling.",
						},
					],
				},
				{
					name: "The Helper",
					number: 2,
					triad: "heart",
					summary:
						"The Caring, Interpersonal Type: Demonstrative, Generous, People-Pleasing, and Possessive",
					wings: [
						{
							number: 1,
							description:
								"An enneagram 2w1 is inclined to help people but is more concerned with providing the proper help that meshes with your morals. Your goal is to be seen as someone others can depend on and a responsible figure. With this wing, you can be more critical of yourself and have trouble expressing your needs.",
						},
						{
							number: 3,
							description:
								"Enneagram 2w3’s are more ambitious and image-conscious than the 2w1. You are very extroverted and more inclined to connect with the people around you. You make an excellent leader because you are also quite competitive. You like to be seen as an expert.",
						},
					],
				},
				{
					name: "The Achiever",
					number: 3,
					triad: "heart",
					summary:
						"The Success-Oriented, Pragmatic Type: Adaptive, Excelling, Driven, and Image-Conscious",
					wings: [
						{
							number: 2,
							description:
								"Enneagram 3w2s are charming and persistent, making excellent entertainers or salespeople. You crave attention from the people around you, but you can get angry or aggressive if you don’t receive it. Though you want to be recognized for your achievements, you still help others.",
						},
						{
							number: 4,
							description:
								"An enneagram 3w4 cares more about staying authentic to yourself than a 3w2. You can get confused because your dominant type is more of a social chameleon, while your wing type values being seen as unique. You pretend to be someone for a crowd but know you’re not yourself.",
						},
					],
				},
				{
					name: "The Individualist",
					number: 4,
					triad: "heart",
					summary:
						"The Sensitive, Withdrawn Type: Expressive, Dramatic, Self-Absorbed, and Temperamental",
					wings: [
						{
							number: 3,
							description:
								"As a 4w3, you want to be unique and the best because you have competitive energy. Because of the third wing’s influence on being image-conscious, you’re more aware of dialing back your emotional intensity than the fourth type with the fifth wing. You want to be different but socially accepted.",
						},
						{
							number: 5,
							description:
								"4w5's are more introverted as both of these influences don't mind being alone. You have unique artistic interests because you are attracted to the avant-garde and eccentric. You value how you are different from others but have less need to be noticed than the fourth type with the fifth wing.",
						},
					],
				},
				{
					name: "The Investigator",
					number: 5,
					triad: "head",
					summary:
						"The Intense, Cerebral Type: Perceptive, Innovative, Secretive, and Isolated",
					wings: [
						{
							number: 4,
							description:
								"An enneagram 5w4 is more sensitive. Sometimes you can come off as more self-absorbed than a 5w6. You are more independent as both type fives and fours enjoy their own company. You have a creative and eccentric personality, which means you are drawn to the unusual.",
						},
						{
							number: 6,
							description:
								"An enneagram 5w6 tends to be more anxious and cautious, influenced by both types. However, you have a more social life than the 5w4, and you are loyal to your loved ones. You are aware of your fear, so you surround yourself with people. You can also sometimes come off as socially awkward.",
						},
					],
				},
				{
					name: "The Loyalist",
					number: 6,
					triad: "head",
					summary:
						"The Committed, Security-Oriented Type: Engaging, Responsible, Anxious, and Suspicious",
					wings: [
						{
							number: 5,
							description:
								"A 6w5 is more introverted, self-controlled, and intellectual than a 6w7. The people you surround yourself with are leaders and others who share the same values. You enjoy your privacy and are sometimes seen as aloof because the fifth wing influences you.",
						},
						{
							number: 7,
							description:
								"An enneagram 6w7 can be playful and entertaining. You’re much more outgoing and adventurous for a dominant type six but not as risky as a dominant type seven. Since sixes are run by anxiety, you always have a backup plan if your adventures go wrong.",
						},
					],
				},
				{
					name: "The Enthusiast",
					number: 7,
					triad: "head",
					summary:
						"The Busy, Fun-Loving Type: Spontaneous, Versatile, Distractible, and Scattered",
					wings: [
						{
							number: 6,
							description:
								"An enneagram 7w6 is more settled rather than rambunctious. You take more time to work on projects before moving on, so your pace is slower than a typical type seven. You commit to relationships more as a 7w6 than those with a dominant eight wing.",
						},
						{
							number: 8,
							description:
								"A 7w8 can appear to be reckless because of your quick pace and competitive, bold attitude. When expressing your ideas, you can be assertive and even get aggressive when others do not agree with you. You are more focused on having a good time than gaining more power.",
						},
					],
				},
				{
					name: "The Challenger",
					number: 8,
					triad: "gut",
					summary:
						"The Powerful, Dominating Type: Self-Confident, Decisive, Willful, and Confrontational",
					wings: [
						{
							number: 7,
							description:
								"Enneagram 8w7s are more outgoing, energetic, and fun. You are ambitious and determined to make a change but can make impulsive and reckless decisions. You like to make the most out of nothing and live your life to its fullest. You are more social than a typical type eight.",
						},
						{
							number: 9,
							description:
								"An enneagram 8w9 is typically more organized and prepared than an 8w7. You are easier to approach and cooperate better with others in the competition. By the influence of the ninth wing, you make an excellent mediator rather than being the source of conflict as a typical eight can be.",
						},
					],
				},
				{
					name: "The Peacemaker",
					number: 9,
					triad: "gut",
					summary:
						"The Easygoing, Self-Effacing Type: Receptive, Reassuring, Agreeable, and Complacent",
					wings: [
						{
							number: 8,
							description:
								"An enneagram 9w8 can often feel conflicted because type nines avoid anger while the eight wing influences it. You are more confident while having stubborn and passive-aggressive tendencies. You have more access to your anger to express your emotions openly when there is conflict.",
						},
						{
							number: 1,
							description:
								"An enneagram 9w1 has a stronger sense between right and wrong to focus on accomplishing their goals. Unlike type nine with an eight wing, you are more introverted and critical toward yourself than others. Through the influence of wing one, you are more likely to take part in social justice.",
						},
					],
				},
			],

			triads: [
				{
					id: "gut",
					name: "The Gut Triad",
					center: "Instinctive Center",
					centerSummary:
						"Led by the gut, decide from a hunch internally without logic, data, or facts. Quick to drive forward based off of what their gut is urging.",
					emotion: "Leading Emotion: Anger",
					emotionSummary:
						"Those in this triad are not necessarily always angry, but rather they carry an internal fire that will drive them towards decisions and tend to show the person to have a lot of passion for whatever issues may be at hand.",
					bullet_descriptors: "Honest, Direct, Intentional",
				},
				{
					id: "heart",
					name: "The Heart Triad",
					center: "Feeling Center",
					centerSummary:
						"Led by emotion, in tune with others feelings around them, able to read the room so to say and make decisions based on their own and percieved emotions of others.",
					emotion: "Leading Emotion: Shame",
					emotionSummary:
						"While all tend to feel shame those in the heart triad may find themselves interacting with it more. This more frequent interaction with the emotion can drive them to better themselves and others in regards to that pit they may feel and drive to fill that pit and have a sense of belonging extended for themselves and others.",
					bullet_descriptors: "Empathetic, Passionate, Selfless",
				},
				{
					id: "head",
					name: "The Head Triad",
					center: "Thinking Center",
					centerSummary:
						"Led by their mind. Very thoughtful and reliant on logic and order generally, will go through methodically before making a decision, tend to not be rash.",
					emotion: "Leading Emotion: Fear",
					emotionSummary:
						"This triad may experience fear of the future more than the others. While this may lead them to not make decisions as swiftly as the types in the other triads and get stuck so to say it can also lend a hand to them making more thought out and efficient decisions.",
					bullet_descriptors: "Thoughtful, Careful, Methodical",
				},
			],

			enneagramCombo(person) {
				const personNumber = person.results.number;
				const personWing = person.results.wing;

				const typeCombo = this.types
					.filter((combo) => combo.number === personNumber)
					.pop();

				// extract wing description from combo
				const wingData = typeCombo.wings
					.filter((wing) => wing.number === personWing)
					.pop();

				const triadData = this.triads
					.filter((triad) => triad.id === typeCombo.triad)
					.pop();

				return new EnneagramResults(
					personNumber,
					personWing,
					typeCombo.name,
					typeCombo.summary,
					wingData.description,
					triadData
				);
			},

			peopleInTeam() {
				return this.people.filter((person) =>
					person.teams.includes(this.focussedTeam)
				);
			},

			peopleWithType() {
				return this.people.filter(
					(person) => person.results.number === this.focussedType.number
				);
			},

			setFocussedType(enneagramType) {
				this.focussedType = enneagramType;
				this.view = "type." + enneagramType.number;
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
				if (view.startsWith("type")) {
					let typeNumber = parseInt(view.split(".").pop());
					// get the number
					const enneagramType = this.types
						.filter((type) => type.number === typeNumber)
						.pop();

					this.setFocussedType(enneagramType);
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
		constructor(firstName, lastName, img, jobTitle, teams, results, uuid) {
			this.firstName = firstName;
			this.lastName = lastName;
			this.img = img;
			this.results = results;
			this.jobTitle = jobTitle;
			this.teams = teams;
			this.uuid = uuid;
		}

		get id() {
			return this.firstName.substring(0, 4) + this.lastName.substring(0, 2);
		}

		get name() {
			return this.firstName + " " + this.lastName;
		}
	}

	class EnneagramResults {
		constructor(number, wing, name, summary, description, triad) {
			this.number = number;
			this.wing = wing;
			this.name = name;
			this.summary = summary;
			this.description = description;
			this.triad = triad;
		}
	}
</script>
  <div class="p-8 space-y-4" x-data="enneagram()" x-init="fetchPeople()">
    <h2 class="text-3xl font-bold tracking-tight text-gray-900">Enneagram</h2>
	{{-- select --}}
	<select x-on:change="setView($el.value)" x-model="view" class="mb-4 w-full sticky top-0 rounded-md border-gray-300">
      <option value="people">Summary</option>
      <optgroup label="Number">
        <template x-for="type in types" :key="type.number" hidden>
          <option :value="`type.${type.number}`" x-text="`${type.number} - ${type.name}`"></option>
        </template>
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
            x-on:click="setFocussedPerson(person)"
            class="flex flex-col items-center justify-center h-60 shadow rounded space-y-2 bg-white hover:bg-gray-50 hover:shadow-md cursor-pointer"
          >
            <img :src="person.img" class="rounded-full w-3/4 max-w-[9rem] aspect-square">
            <p class="leading-6">
              <span x-text="person.firstName"></span>
              <span x-text="person.lastName"></span>
            </p>
            <div class="flex space-x-1 bg-gray-100 px-1 rounded-medium">
              <span x-text="person.results.number"></span>
              <span>w</span>
              <span x-text="person.results.wing"></span>
            </div>
          </div>
        </template>
      </div>
    </template>

    <template x-if="view.startsWith('type')">
      <!-- Single type focus -->
      <div class="py-4 space-y-4">
        <!-- type name -->
        <h1 class="font-bold text-2xl text-gray-900" x-text="focussedType.name"></h1>
        <p x-text="focussedType.summary"></p>

        <!-- list of people with type -->
        <template x-for="person in peopleWithType()" hidden>
          <div class="flex space-x-4 items-center">
            <img :src="person.img" class="h-8 w-8 rounded-full">
            <a
              x-on:click.prevent="setFocussedPerson(person)"
              x-text="person.name"
              class="w-48 truncate"
              href="#"
            ></a>
            <div class="flex space-x-2">
              <div class="flex space-x-1">
                <span x-text="person.results.number"></span>
                <span>w</span>
                <span x-text="person.results.wing"></span>
              </div>
            </div>
          </div>
        </template>
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
		  <a :href="'/submit?test_identifier=enneagram&user_uuid='+focussedPerson.uuid">Edit</a>
        </div>
        <!-- enneagram number and title -->
		<div class="flex flex-row space-x-2">
			<div
				x-text="focussedPerson.results.number"
				class="w-16 h-16 inline-flex items-center justify-center font-semibold rounded-md text-xl bg-gray-100 text-gray-700"
				href="#"
			></div>
			<div
				x-text="'w'+focussedPerson.results.wing"
				class="w-16 h-16 inline-flex items-center justify-center font-semibold rounded-md text-xl bg-blue-50 text-gray-700"
				href="#"
			></div>
		</div>
        <div>
          <div class="flex flex-wrap gap-2">
            <template x-for="team in focussedPerson.teams" hidden>
              <a
                x-on:click.prevent="setFocussedTeam(team)"
                x-text="team"
                class="rounded-full px-3 py-2 border border-blue-200 bg-blue-100 hover:bg-blue-200 text-blue-700"
                href="#"
              ></a>
            </template>
          </div>
        </div>
        <!-- combo description -->
        <div class="space-y-4">
          <p class="text-lg font-semibold" x-text="`Type ${enneagramCombo(focussedPerson).number}: ${enneagramCombo(focussedPerson).name}`"></p>
          <div class="max-w-xl space-y-2">
            <p class="underline text-gray-700" x-text="enneagramCombo(focussedPerson).summary"></p>
            <p class="pl-8 border-l-4 text-gray-700" x-text="enneagramCombo(focussedPerson).description"></p>
          </div>
          <!-- triad data here -->
          <p class="text-md font-semibold" x-text="enneagramCombo(focussedPerson).triad.name"></p>
          <div class="max-w-xl space-y-2 pl-8 border-l-4">
            <p class="text-gray-500" x-text="enneagramCombo(focussedPerson).triad.center"></p>
            <p x-text="enneagramCombo(focussedPerson).triad.centerSummary"></p>
          </div>
          <div class="max-w-xl space-y-2 pl-8 border-l-4">
            <p class="text-gray-500" x-text="enneagramCombo(focussedPerson).triad.emotion"></p>
            <p x-text="enneagramCombo(focussedPerson).triad.emotionSummary"></p>
          </div>
          <div class="max-w-xl space-y-2 pl-8 border-l-4">
            <p class="text-gray-500" x-text="enneagramCombo(focussedPerson).triad.bullet_descriptors"></p>
          </div>
          <!-- get triad for person -->
        </div>
      </div>
    </template>

    <template x-if="view.startsWith('team')">
      <!-- Single team focus-->
      <div class="py-4 space-y-4">
        <div class="flex items-center space-x-6">
          <h1 class="font-bold text-2xl text-gray-900" x-text="focussedTeam"></h1>
        </div>
        <!-- list of people with their type -->
        <div class="space-y-2">
          <template x-for="person in peopleInTeam()" hidden>
            <div class="flex space-x-4 items-center">
              <img :src="person.img" class="h-8 w-8 rounded-full">
              <a
                x-on:click.prevent="setFocussedPerson(person)"
                x-text="person.name"
                class="w-48 truncate"
                href="#"
              ></a>
              <div class="flex space-x-2">
                <div class="flex space-x-1">
                  <span x-text="person.results.number"></span>
                  <span>w</span>
                  <span x-text="person.results.wing"></span>
                </div>
              </div>
            </div>
          </template>
        </div>
      </div>
    </template>

  </div>
</div>
@stop
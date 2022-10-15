@extends('layout')

@section('content')
  <script src="/scripts/enneagram.js"></script>
  <div class="p-8" x-data="enneagram()">
    {{-- select --}}
	<select x-on:change="setView($el.value)" x-model="view" class="mb-4 w-full sticky top-0 rounded-md border-gray-300">
      <option value="people">Home</option>
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
            class="flex flex-col items-center justify-center h-60 shadow rounded space-y-2 hover:bg-gray-50 hover:shadow-md cursor-pointer"
          >
            <img :src="person.img" class="rounded-full w-3/4 max-w-[9rem] aspect-square">
            <p class="leading-6">
              <span x-text="person.firstName"></span>
              <span x-text="person.lastName"></span>
            </p>
            <div class="flex space-x-1">
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
        </div>
        <!-- enneagram number and title -->
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
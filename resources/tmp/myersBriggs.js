function myersBriggs() {
  return {
    focussedDivision: null,
    focussedPerson: null,
    focussedTeam: null,

    get teams() {
      let allTeams = this.people.map((person) => person.teams).flat();
      // return only unique teams
      return [...new Set(allTeams)];
    },

    people: [
      new Person(
        "Gavin",
        "Courtney",
        "https://cdn.churchsuite.com/Nr6TJr3e/addressbook/contacts/7_uj4pxwBT_thumb.jpg",
        "Managing Director",
        ["Business", "Developer", "Support", "Marketing"],
        ["E", "N", "T", "J"]
      ),
      new Person(
        "Luke",
        "Salter",
        "https://cdn.churchsuite.com/Nr6TJr3e/addressbook/contacts/2297_3UuQ6vGE_thumb.jpg",
        "Lead Developer",
        ["Business", "Developer", "Marketing"],
        ["I", "N", "T", "J"]
      ),
      new Person(
        "Shane",
        "Coates",
        "https://cdn.churchsuite.com/Nr6TJr3e/addressbook/contacts/5469_OObUkNFm_thumb.jpg",
        "Developer",
        ["Developer", "Marketing"],
        ["E", "N", "F", "P"]
      ),
      new Person(
        "Ant",
        "Weedon",
        "https://cdn.churchsuite.com/Nr6TJr3e/addressbook/contacts/7149_FEuMo9Ps_thumb.jpg",
        "Developer",
        ["Developer"],
        ["I", "S", "F", "J"]
      ),
      new Person(
        "Paul",
        "Nation",
        "https://cdn.churchsuite.com/Nr6TJr3e/addressbook/contacts/7716_fYugK8Ap_thumb.jpg",
        "Support",
        ["Support"],
        ["E", "S", "T", "J"]
      ),
    ],
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
        id: "INFp",
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
      console.log(this.focussedDivision);
      // get people with types

      return [];
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
  constructor(firstName, lastName, img, jobTitle, teams, mbti) {
    this.firstName = firstName;
    this.lastName = lastName;
    this.img = img;
    this.jobTitle = jobTitle;
    this.teams = teams;
    this.mbti = mbti;
  }

  get id() {
    return this.firstName.substring(0, 4) + this.lastName.substring(0, 2);
  }

  get name() {
    return this.firstName + " " + this.lastName;
  }
}

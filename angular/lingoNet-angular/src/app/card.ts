export class Card {
   constructor(
      public firstName: string,
      public lastName: string,
      public email: string,
      public friendEmail: string,
      public cardEmail: string,
      public phone: string,
      public natives: [string] | null,
      public targets: [string] | null,
   ){}
}

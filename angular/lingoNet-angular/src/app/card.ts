export class Card {
   constructor(
      public firstName: string,
      public lastName: string,
      public email: string,
      public natives: [string] | null,
      public targets: [string] | null,
   ){}
}

actions = require "../../../lib/hearts/actions"
Card = require "../../../lib/hearts/card"
Suit = require "../../../lib/hearts/suit"
Rank = require "../../../lib/hearts/rank"

describe "actions", ->
  beforeEach ->
    @game = Factory.createGame()

  describe "PassCards", ->
    beforeEach ->
      @game.startRound()

    describe "#execute", ->
      # it "applies and emits the passed cards for the player", ->
      it "applies the passed cards for the player", ->
        northCards = @game.currentRound().seats.north.dealt.cards[1..3]
        eastCards = @game.currentRound().seats.east.dealt.cards[1..3]
        southCards = @game.currentRound().seats.south.dealt.cards[1..3]
        westCards = @game.currentRound().seats.west.dealt.cards[1..3]

        new actions.PassCards(northCards).execute(@game, "north")
        new actions.PassCards(eastCards).execute(@game, "east")
        new actions.PassCards(southCards).execute(@game, "south")
        new actions.PassCards(westCards).execute(@game, "west")

        expect(@game.currentRound().seats.north.passed.cards).to.eql(northCards)
        expect(@game.currentRound().seats.east.passed.cards).to.eql(eastCards)
        expect(@game.currentRound().seats.south.passed.cards).to.eql(southCards)
        expect(@game.currentRound().seats.west.passed.cards).to.eql(westCards)

        # @game.positions.north.out.recvPassed (err, passed) ->
        #   should.not.exist(err)
        #   passed.should.equal(southCards)
        #   done()

    describe "#validate", ->
      it "returns null for valid actions", ->
        cards = @game.currentRound().seats.north.dealt.cards[1..3]
        action = new actions.PassCards(cards)

        expect(action.validate(@game, "north")).to.not.exist

      it "returns an error if less than three cards", ->
        cards = @game.currentRound().seats.north.dealt.cards[1..2]
        action = new actions.PassCards(cards)

        error = action.validate(@game, "north")
        expect(error.type).to.equal "invalidMove"
        expect(error.message).to.equal "Must pass three cards. You passed 2."

      it "returns an error if more than three cards", ->
        cards = @game.currentRound().seats.north.dealt.cards[1..4]
        action = new actions.PassCards(cards)

        error = action.validate(@game, "north")
        expect(error.type).to.equal "invalidMove"
        expect(error.message).to.equal "Must pass three cards. You passed 4."

      it "returns an error if passing someone else's card", ->
        cards = @game.currentRound().seats.south.dealt.cards[1..3]
        action = new actions.PassCards(cards)

        error = action.validate(@game, "north")
        expect(error.type).to.equal "invalidMove"
        expect(error.message).to.equal "Must pass cards in your hand."

      it "returns an error if passing the same card multiple times", ->
        twoCards = @game.currentRound().seats.south.dealt.cards[1..2]
        cards = twoCards.concat(twoCards[0])
        action = new actions.PassCards(cards)

        error = action.validate(@game, "south")
        expect(error.type).to.equal "invalidMove"
        expect(error.message).to.equal "Must pass a card no more than once."

      it "returns an error if passing multiple times", ->
        cards = @game.currentRound().seats.north.dealt.cards[1..3]
        action = new actions.PassCards(cards)
        action.execute(@game, "north")

        action = new actions.PassCards(@game.positions.north, cards)

        error = action.validate(@game, "north")
        expect(error.type).to.equal("invalidMove")
        expect(error.message).to.equal("May not pass more than once in a round.")

  describe "PlayCard", ->
    beforeEach ->
      @game.startRound()
      @game.startTrick()

    describe "#execute", ->
      it "applies the card", ->
        card = @game.currentRound().seats.north.dealt.cards[0]

        action = new actions.PlayCard(card)
        action.execute(@game, "north")

        expect(@game.currentRound().currentTrick().played.cards[0]).to.equal(card)

    describe "#validate", ->
      describe "first trick", ->
        beforeEach ->
          expect(@game.currentRound().tricks).to.have.length(1)

        it "returns null if leading with two of clubs", ->
          card1 = new Card(Suit.CLUBS, Rank.TWO)
          card2 = new Card(Suit.SPADES, Rank.TWO)
          @game.currentRound().seats.north.held.cards = [card1, card2]
          action = new actions.PlayCard(card1)

          error = action.validate(@game, "north")
          expect(error).to.not.exist

        it "returns an error if not playing two of clubs on first hand", ->
          card1 = new Card(Suit.CLUBS, Rank.TWO)
          card2 = new Card(Suit.SPADES, Rank.TWO)
          @game.currentRound().seats.north.held.cards = [card1, card2]
          action = new actions.PlayCard(card2)

          error = action.validate(@game, "north")

          expect(error.type).to.equal("invalidMove")
          expect(error.message).to.equal("Must lead round with two of clubs.")

        it "returns an error if queen of spades is played", ->
          @game.currentRound().currentTrick().played.addCard(new Card(Suit.CLUBS, Rank.TWO))
          @game.currentRound().currentTrick().played.addCard(new Card(Suit.CLUBS, Rank.NINE))

          card1 = new Card(Suit.SPADES, Rank.QUEEN)
          card2 = new Card(Suit.DIAMONDS, Rank.KING)
          @game.currentRound().seats.north.held.cards = [card1, card2]
          action = new actions.PlayCard(card1)

          error = action.validate(@game, "north")

          expect(error.type).to.equal "invalidMove"
          expect(error.message).to.equal "Must not play points in the first trick of a round."

        it "returns an error if a heart is played", ->
          @game.currentRound().currentTrick().played.addCard(new Card(Suit.CLUBS, Rank.TWO))
          @game.currentRound().currentTrick().played.addCard(new Card(Suit.CLUBS, Rank.NINE))

          card1 = new Card(Suit.HEARTS, Rank.QUEEN)
          card2 = new Card(Suit.DIAMONDS, Rank.KING)
          @game.currentRound().seats.north.held.cards = [card1, card2]
          action = new actions.PlayCard(card1)

          error = action.validate(@game, "north")

          expect(error.type).to.equal "invalidMove"
          expect(error.message).to.equal "Must not play points in the first trick of a round."

        it "returns null if queen of spades is played with hand of the queen and all hearts", ->
          @game.currentRound().currentTrick().played.addCard(new Card(Suit.CLUBS, Rank.TWO))
          @game.currentRound().currentTrick().played.addCard(new Card(Suit.CLUBS, Rank.NINE))

          card1 = new Card(Suit.SPADES, Rank.QUEEN)
          @game.currentRound().seats.north.held.cards = [
            card1,
            new Card(Suit.HEARTS, Rank.THREE),
            new Card(Suit.HEARTS, Rank.FOUR),
            new Card(Suit.HEARTS, Rank.FIVE),
            new Card(Suit.HEARTS, Rank.SIX),
            new Card(Suit.HEARTS, Rank.SEVEN),
            new Card(Suit.HEARTS, Rank.EIGHT),
            new Card(Suit.HEARTS, Rank.NINE),
            new Card(Suit.HEARTS, Rank.TEN),
            new Card(Suit.HEARTS, Rank.JACK),
            new Card(Suit.HEARTS, Rank.QUEEN),
            new Card(Suit.HEARTS, Rank.KING),
            new Card(Suit.HEARTS, Rank.ACE)
          ]

          action = new actions.PlayCard(card1)

          error = action.validate(@game, "north")

          expect(error).to.not.exist


        it "returns null if a heart is played with hand of all hearts", ->
          @game.currentRound().currentTrick().played.addCard(new Card(Suit.CLUBS, Rank.TWO))
          @game.currentRound().currentTrick().played.addCard(new Card(Suit.CLUBS, Rank.NINE))

          card1 = new Card(Suit.HEARTS, Rank.TWO)
          @game.currentRound().seats.north.held.cards = [
            card1,
            new Card(Suit.HEARTS, Rank.THREE),
            new Card(Suit.HEARTS, Rank.FOUR),
            new Card(Suit.HEARTS, Rank.FIVE),
            new Card(Suit.HEARTS, Rank.SIX),
            new Card(Suit.HEARTS, Rank.SEVEN),
            new Card(Suit.HEARTS, Rank.EIGHT),
            new Card(Suit.HEARTS, Rank.NINE),
            new Card(Suit.HEARTS, Rank.TEN),
            new Card(Suit.HEARTS, Rank.JACK),
            new Card(Suit.HEARTS, Rank.QUEEN),
            new Card(Suit.HEARTS, Rank.KING),
            new Card(Suit.HEARTS, Rank.ACE)
          ]

          action = new actions.PlayCard(card1)

          error = action.validate(@game, "north")
          expect(error).to.not.exist

        it "returns an error if not following suit when able", ->
          @game.currentRound().currentTrick().played.addCard(new Card(Suit.CLUBS, Rank.TWO))
          @game.currentRound().currentTrick().played.addCard(new Card(Suit.CLUBS, Rank.NINE))

          card1 = new Card(Suit.DIAMONDS, Rank.FOUR)
          card2 = new Card(Suit.CLUBS, Rank.KING)
          @game.currentRound().seats.north.held.cards = [card1, card2]
          action = new actions.PlayCard(card1)

          error = action.validate(@game, "north")

          expect(error.type).to.equal "invalidMove"
          expect(error.message).to.equal "Must follow suit."

        it "returns null if not following suit legally", ->
          @game.currentRound().currentTrick().played.addCard(new Card(Suit.CLUBS, Rank.TWO))
          @game.currentRound().currentTrick().played.addCard(new Card(Suit.CLUBS, Rank.NINE))

          card1 = new Card(Suit.DIAMONDS, Rank.FOUR)
          card2 = new Card(Suit.HEARTS, Rank.KING)
          @game.currentRound().seats.north.held.cards = [card1, card2]
          action = new actions.PlayCard(card1)

          error = action.validate(@game, "north")
          expect(error).to.not.exist

      describe "hearts unbroken", ->
        beforeEach ->
          @game.currentRound().currentTrick().played.addCard(new Card(Suit.CLUBS, Rank.TWO))
          @game.currentRound().currentTrick().played.addCard(new Card(Suit.CLUBS, Rank.FOUR))
          @game.currentRound().currentTrick().played.addCard(new Card(Suit.CLUBS, Rank.SIX))
          @game.currentRound().currentTrick().played.addCard(new Card(Suit.CLUBS, Rank.EIGHT))
          @game.currentRound().newTrick()

          expect(@game.currentRound().tricks).to.have.length(2)

        it "returns null if leading with a non heart", ->
          card = new Card(Suit.DIAMONDS, Rank.TWO)
          @game.currentRound().seats.north.held.cards = [card]
          action = new actions.PlayCard(card)

          expect(action.validate(@game, "north")).to.not.exist

        it "returns an error if leading with a heart", ->
          card1 = new Card(Suit.HEARTS, Rank.TWO)
          card2 = new Card(Suit.DIAMONDS, Rank.THREE)
          @game.currentRound().seats.north.held.cards = [card1, card2]
          action = new actions.PlayCard(card1)

          error = action.validate(@game, "north")

          expect(error.type).to.equal("invalidMove")
          expect(error.message).to.equal("Must not play a heart until broken.")

        it "returns null if only hearts remain", ->
          card1 = new Card(Suit.HEARTS, Rank.TWO)
          card2 = new Card(Suit.HEARTS, Rank.THREE)
          @game.currentRound().seats.north.held.cards = [card1, card2]
          action = new actions.PlayCard(card1)

          error = action.validate(@game, "north")
          expect(error).to.not.exist

      describe "hearts broken", ->
        beforeEach ->
          @game.currentRound().currentTrick().played.addCard(new Card(Suit.CLUBS, Rank.TWO))
          @game.currentRound().currentTrick().played.addCard(new Card(Suit.CLUBS, Rank.FOUR))
          @game.currentRound().currentTrick().played.addCard(new Card(Suit.CLUBS, Rank.SIX))
          @game.currentRound().currentTrick().played.addCard(new Card(Suit.CLUBS, Rank.EIGHT))
          @game.currentRound().newTrick()
          @game.currentRound().currentTrick().played.addCard(new Card(Suit.DIAMONDS, Rank.TWO))
          @game.currentRound().currentTrick().played.addCard(new Card(Suit.DIAMONDS, Rank.FOUR))
          @game.currentRound().currentTrick().played.addCard(new Card(Suit.DIAMONDS, Rank.SIX))
          @game.currentRound().currentTrick().played.addCard(new Card(Suit.HEARTS, Rank.EIGHT))
          @game.currentRound().newTrick()

          expect(@game.currentRound().tricks).to.have.length(3)

        it "returns null when leading with a heart", ->
          card = new Card(Suit.HEARTS, Rank.FOUR)
          @game.currentRound().seats.north.held.cards = [card]
          action = new actions.PlayCard(card)

          error = action.validate(@game, "north")
          expect(error).to.not.exist

        it "returns an error if playing a card not in hand", ->
          someOtherCard = @game.currentRound().seats.south.dealt.cards[0]
          action = new actions.PlayCard(someOtherCard)

          error = action.validate(@game, "north")

          expect(error.type).to.equal("invalidMove")
          expect(error.message).to.equal("Must play a card in your hand.")

        it "returns null if not following suit legally", ->
          @game.currentRound().currentTrick().played.addCard(new Card(Suit.CLUBS, Rank.FIVE))
          @game.currentRound().currentTrick().played.addCard(new Card(Suit.CLUBS, Rank.NINE))
          card = new Card(Suit.HEARTS, Rank.FOUR)
          @game.currentRound().seats.north.held.cards = [card]
          action = new actions.PlayCard(card)

          error = action.validate(@game, "north")
          expect(error).to.not.exist

        it "returns an error if not following suit when able", ->
          @game.currentRound().currentTrick().played.addCard(new Card(Suit.CLUBS, Rank.FIVE))
          @game.currentRound().currentTrick().played.addCard(new Card(Suit.CLUBS, Rank.NINE))
          card1 = new Card(Suit.HEARTS, Rank.FOUR)
          card2 = new Card(Suit.CLUBS, Rank.KING)
          @game.currentRound().seats.north.held.cards = [card1, card2]
          action = new actions.PlayCard(card1)

          error = action.validate(@game, "north")

          expect(error.type).to.equal "invalidMove"
          expect(error.message).to.equal "Must follow suit."

        it "returns an error if same card played multiple times during round", ->
          card = new Card(Suit.HEARTS, Rank.FOUR)
          @game.currentRound().seats.north.dealt.cards = [card]
          @game.currentRound().seats.north.held.cards = [card]

          new actions.PlayCard(card).execute(@game, "north")
          action = new actions.PlayCard(card)

          error = action.validate(@game, "north")

          expect(error.type).to.equal "invalidMove"
          expect(error.message).to.equal "Must play a card in your hand."

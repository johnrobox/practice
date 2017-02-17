Seat = require './seat'
Suit = require './suit'
Rank = require './rank'
Trick = require './trick'
Pile = require './pile'

module.exports = class Round
  constructor: (@passing) ->
    @seats =
      north: new Seat()
      east: new Seat()
      south: new Seat()
      west: new Seat()

    @tricks = []

  currentTrick: ->
    @tricks[@tricks.length - 1]

  newTrick: ->
    if @tricks.length == 0
      # TODO: refactor out positions array
      positions = ["north", "east", "south", "west"]

      startingPosition = do (positions) =>
        for position in positions
          return position if @seats[position].held.findCard(Suit.CLUBS, Rank.TWO)

      @tricks.push(new Trick(startingPosition))
    else
      winner = @currentTrick().winner()
      @tricks.push(new Trick(winner))

    @currentTrick()

  allHavePassed: ->
    @seats.north.hasPassed() && @seats.east.hasPassed() && @seats.south.hasPassed() && @seats.west.hasPassed()

  exchange: ->
    exchangePairs =
      right: [["north", "west"], ["east", "north"], ["south", "east"], ["west", "south"]]
      left: [["north", "east"], ["east", "south"], ["south", "west"], ["west", "north"]]
      across: [["north", "south"], ["east", "west"], ["south", "north"], ["west", "east"]]

    pairs = exchangePairs[@passing]

    for pair in pairs
      do =>
        fromPosition = pair[0]
        toPosition = pair[1]
        fromSeat = @seats[fromPosition]
        toSeat = @seats[toPosition]
        passedCards = fromSeat.passed.cards

        for card in passedCards
          toSeat.received.addCard(card)
          fromSeat.held.moveCardTo(card, toSeat.held)

  deal: ->
    deck = Pile.createShuffledDeck()
    positions = ["north", "east", "south", "west"]
    for position in positions
      seat = @seats[position]
      deck.moveCardsTo(13, seat.dealt)
      seat.dealt.copyAllCardsTo(seat.held)

  scores: ->
    zeroscores =
      north: 0
      east: 0
      south: 0
      west: 0

    scores = @tricks.reduce (memo, trick) ->
      memo[trick.winner()] += trick.score()
      memo
    , zeroscores

    for position in ['north', 'east', 'south', 'west']
      if scores[position] == 26
        scores.north = 26
        scores.east = 26
        scores.south = 26
        scores.west = 26
        scores[position] = 0
        scores.shooter = position
        break
    scores

  isHeartsBroken: ->
    @tricks.some (trick) ->
      trick.played.allOfSuit(Suit.HEARTS).cards.length > 0

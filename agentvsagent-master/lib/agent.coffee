machina = require('machina')()
Q = require 'q'
logger = require '../lib/logger'
{EventEmitter} = require 'events'

AgentState = machina.Fsm.extend
  initialize: (options) ->
    @agent = options.agent
    @timeout = options.timeout
  "*": ->
    logger.error "Agent received unexpected message", @state, arguments

  initialState: "waitingForClient"
  states:
    waitingForServer:
      send: (message, data) ->
        if message == "end" || message == "error"
          @transition("finished")
        else
          @transition("waitingForClient")

        if message == "error"
          @request.reject(message: message, data: data || {})
        else
          @request.resolve(message: message, data: data || {})

      forward: (message, data, request) ->
        request.reject("unexpectedMessage")

    waitingForClient:
      _onEnter: ->
        if @timeout
          @timer = setTimeout =>
            logger.error "timeout!"
            @transition("timedOut")
          , @timeout

      forward: (message, data, @request)->
        @transition "waitingForServer"
        heard = @agent.emit message, data
        if !heard
          logger.error "no one was listening to #{message}"

      _onExit: ->
        clearTimeout(@timer)

    timedOut:
      _onEnter: ->
        logger.error "agent timeout"
        @agent.emit "timeout"

    finished: {}

module.exports = class Agent extends EventEmitter
  constructor: (options={}) ->
    @state = new AgentState(agent: this, timeout: options.timeout)
    @state.on "transition", (details) ->
      message = "AGENT changed state from #{details.fromState} to #{details.toState}, because of #{details.action}"
      # console.log message
      logger.verbose message

  forward: (message, data) ->
    logger.verbose "<<<<<forwarding", message, " - ", data
    request = Q.defer()
    @state.handle "forward", message, data, request
    request.promise

  send: (message, data) ->
    logger.verbose ">>>>>>>sending", message, " - ", data
    @state.handle "send", message, data

  # end: (message, data)


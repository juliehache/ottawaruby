require 'rubygems'
require 'sinatra'
require 'haml' #forgoing sass for now

enable :sessions

# Shall we set up a DB?

helpers do
  
  def protected!
    response['WWW-Authenticate'] = %(Basic realm="Testing HTTP Auth") and \
    throw(:halt, [401, "Not authorized\n"]) and \
    return unless authorized?
  end

  def authorized?
    @auth ||=  Rack::Auth::Basic::Request.new(request.env)
    @auth.provided? && @auth.basic? && @auth.credentials && @auth.credentials == ['ottawaruby_admin', 'superultrasecret']
  end

end


get '/' do
  haml :index
end

get '/admin' do 
  protected!
  haml :admin
end

post '/admin' do
  protected!
  haml :admin
end

get '*' do
  haml :index
end
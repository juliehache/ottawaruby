require 'rubygems'
require 'sinatra'
require 'haml' #forgoing sass for now

set :environment, :production

configure :production do
  set :admin_user, ENV['OR_USERNAME']
  set :admin_pass, ENV['OR_PASSWORD']
end

helpers do

  def protected!
    response['WWW-Authenticate'] = %(Basic realm="OttawaRuby Admin Login") and \
    throw(:halt, [401, "Not authorized\n"]) and \
    return unless authorized?
  end

  def authorized?
    @auth ||= Rack::Auth::Basic::Request.new(request.env)
    @auth.provided? && @auth.basic? && @auth.credentials && @auth.credentials == [options.admin_user, options.admin_pass]
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
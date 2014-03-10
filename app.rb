require 'bundler/setup'
Bundler.require
require 'digest/md5'

class App < Sinatra::Base
  register Sinatra::Reloader

  set :server, :thin
  set :bind, '0.0.0.0'

  helpers do
    def gravatar(email, size=180)
      "http://www.gravatar.com/avatar/#{Digest::MD5.hexdigest(email)}?s=#{size}&d=mm&r=g"
    end
  end

  get '/' do
    erb :index
  end

  get '/about' do
    erb :about
  end

  get '/blog' do
    erb :blog
  end

  get '/css/*.css' do
    content_type 'text/css', :charset => 'utf-8'
    filename = params[:splat].first
    scss filename.to_sym, :views => "#{settings.root}/assets/stylesheets"
  end

  run! if app_file == $0
end

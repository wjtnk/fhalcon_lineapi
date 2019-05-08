Vagrant.configure("2") do |config|
  config.vm.box = "CentOS7"
  #ローカルでアクセスするときのIPアドレス。
  config.vm.network "private_network", ip: "192.168.10.10"
  #同期先を指定。「カレントディレクトリ（.）を/vagrant以下に同期」と、「syncディレクトリを/var/www/」以下に同期する。
  config.vm.synced_folder ".", "/vagrant"
  config.vm.synced_folder "sync", "/var/www/"
  config.vm.network "forwarded_port", guest: 80, host: 8000
  #ここで、epelとremiを使えるようにします。
  config.vm.provision "shell", inline: <<-SHELL
    sudo yum update -y
    sudo yum -y install epel-release
    sudo rpm -Uvh http://rpms.famillecollet.com/enterprise/remi-release-7.rpm
  SHELL
end

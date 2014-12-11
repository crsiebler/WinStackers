module VagrantVars
    SERVER_NAME = "Win Stacker Task Management" #name of the project
    HOST_NAME = "winstacker.app" #url that will be used for accessing the machine
    IP_ADDRESS = "192.168.100.101" #IP address for the server. It is important that this does not conflict with the IP address range of your local network

    # Ansible vars below
    DATABASE_USER = "root" #user to use the database as
    DATABASE_PASSWORD = "password" #password for the database user
    DATABASE_NAME = "winstacker" #database name
end

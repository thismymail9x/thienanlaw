cd /etc/openvpn/easy-rsa
source ./vars
./clean-all
./build-ca
./build-dh
mkdir /etc/openvpn/server/serverall
cp /etc/openvpn/easy-rsa/keys/dh2048.pem /etc/openvpn/easy-rsa/keys/ca.crt /etc/openvpn/easy-rsa/keys/ca.key /etc/openvpn/server/serverall
./build-key-server /etc/openvpn/server/serverall/serverall
./build-key /etc/openvpn/server/serverall/clientall


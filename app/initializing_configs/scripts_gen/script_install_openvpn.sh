yum remove openvpn -y
rm -rf /etc/openvpn
yum update -y
yum install epel-release -y
yum install -y openvpn wget
yum update -y
wget -O /tmp/easyrsa https://github.com/OpenVPN/easy-rsa-old/archive/2.3.3.tar.gz
tar xfz /tmp/easyrsa
mkdir /etc/openvpn/easy-rsa
cp -rf easy-rsa-old-2.3.3/easy-rsa/2.0/* /etc/openvpn/easy-rsa
mkdir /etc/openvpn/easy-rsa/keys
systemctl disable iptables
systemctl stop iptables
systemctl enable firewalld
systemctl start firewalld
firewall-cmd --permanent --add-service=openvpn
firewall-cmd --add-masquerade
service firewalld restart
vi /etc/sysctl.conf
#add content to end of file: net.ipv4.ip_forward = 1
systemctl restart systemd-sysctl
systemctl restart network.service
setfacl -m user:root:rw /etc/openvpn

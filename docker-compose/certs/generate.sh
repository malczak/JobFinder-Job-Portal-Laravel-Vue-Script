#!/bin/bash
DOMAIN='finejobs.test'
PASS=qwe123
ROOT_KEY=root_ca.key
ROOT_CRT=root_ca.pem
SSL_KEY=ssl_cert.key
SSL_CRT=ssl_cert.crt

# Generate key
if [ ! -f $ROOT_KEY ]; then
        echo "< Generate RootCA key"
        openssl genrsa -des3 -passout pass:$PASS -out $ROOT_KEY 2048
else
        echo "< RootCA key exists"
fi

# Generate root cert
if [ ! -f $ROOT_CRT ]; then
        echo "< Generate root certificate"
        openssl req -x509 -new -nodes -key $ROOT_KEY -sha256 -days 1024 -passin pass:$PASS -out $ROOT_CRT -subj "/C=PL/ST=Slaskie/L=Katowice/O=The Pirate Cat/OU=TPC Local"
        # Install root ca as trusted
        sudo security add-trusted-cert -d -r trustRoot -k /Library/Keychains/System.keychain $ROOT_CRT
else
        echo "< RootCA certificate exists"
fi

# Generate domain cert
echo "< Generate certificate"
cp /etc/ssl/openssl.cnf /tmp
echo '\n[ subject_alt_name ]' >> /tmp/openssl.cnf
echo "subjectAltName = DNS:$DOMAIN, DNS:static.$DOMAIN, DNS:api.$DOMAIN, DNS:app.$DOMAIN, DNS:api.$DOMAIN::, DNS:$DOMAIN::" >> /tmp/openssl.cnf
openssl req -new -sha256 -nodes -newkey rsa:2048 \
        -config /tmp/openssl.cnf \
        -extensions subject_alt_name \
        -keyout $SSL_KEY \
        -out ssl_cert.csr \
        -subj "/C=PL/ST=Slaskie/L=Katowice/O=The Pirate Cat/OU=IT Department/CN=$DOMAIN"

openssl x509 -req -in ssl_cert.csr \
        -CA $ROOT_CRT -CAkey $ROOT_KEY -CAcreateserial \
        -passin pass:$PASS \
        -extfile /tmp/openssl.cnf \
        -extensions subject_alt_name \
        -days 500 -sha256 \
        -out $SSL_CRT

echo "< Done."
